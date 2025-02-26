<?php

namespace Controllers;


require_once 'vendor/autoload.php'; // Importa el autoload de Composer

use Flight;
use Google\Client as Google_Client;
use Google\Service\Calendar;
use Google\Service\Calendar\Event as Google_Service_Calendar_Event; 

class CalendarController {




    public function CalendarAuth() {
        $client = new Google_Client();
        $client->setAuthConfig(realpath(__DIR__ . '/../utils/credentials.json'));
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');

         // Agrega el scope para Google Calendar
        $client->setScopes(Calendar::CALENDAR);

        $authUrl = $client->createAuthUrl();
        Flight::redirect($authUrl);
    }

    public function CalendarInit(){
        $code = Flight::request()->query['code'];

        // Configura el cliente de Google
        $client = new Google_Client();
        $client->setAuthConfig(realpath(__DIR__ . '/../utils/credentials.json'));
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');

        // Intercambia el código por un token de acceso
        $accessToken = $client->fetchAccessTokenWithAuthCode($code);
        $client->setAccessToken($accessToken);

        // Guarda el token en un archivo
        $tokenPath = __DIR__ . '/../utils/token.json';
        if (!file_exists(dirname($tokenPath))) {
            mkdir(dirname($tokenPath), 0700, true);
        }
        file_put_contents($tokenPath, json_encode($client->getAccessToken()));

        // Respuesta al usuario
        echo 'Autenticación exitosa. Token guardado.';
    }

    public function CreateEvent() {
        $client = new Google_Client();
        $client->setAuthConfig(realpath(__DIR__ . '/../utils/credentials.json'));
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');
        $client->setScopes(Calendar::CALENDAR);
    
        // Ruta al archivo donde se guarda el token
        $tokenPath = realpath(__DIR__ . '/../utils/token.json');
    
        // Si ya tienes un token guardado, cárgalo
        if (file_exists($tokenPath)) {
            $accessToken = json_decode(file_get_contents($tokenPath), true);
            $client->setAccessToken($accessToken);
        }
    
        // Si el token de acceso ha expirado, renóvalo
        if ($client->isAccessTokenExpired()) {
            if ($client->getRefreshToken()) {
                // Renueva el token de acceso usando el token de actualización
                $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
    
                // Guarda el nuevo token de acceso
                file_put_contents($tokenPath, json_encode($client->getAccessToken()));
            } else {
                // Si no hay token de actualización, redirige al usuario para autorizar la aplicación
                $authUrl = $client->createAuthUrl();
                header('Location: ' . $authUrl);
                exit;
            }
        }
    
        $service = new Calendar($client);
    
        // Define el evento
        $event = new Google_Service_Calendar_Event(array(
            'summary' => 'Evento de prueba',
            'location' => 'En línea',
            'description' => 'Este es un evento de prueba creado desde PHP.',
            'start' => array(
                'dateTime' => '2025-02-26T09:00:00-07:00',
                'timeZone' => 'America/Los_Angeles',
            ),
            'end' => array(
                'dateTime' => '2025-02-26T17:00:00-07:00',
                'timeZone' => 'America/Los_Angeles',
            ),
            'attendees' => array(
                array('email' => 'daniel.aracenach@gmail.com'),
            ),
            'reminders' => array(
                'useDefault' => false,
                'overrides' => array(
                    array('method' => 'email', 'minutes' => 24 * 60),
                    array('method' => 'popup', 'minutes' => 10),
                ),
            ),
        ));
    
        // Crea el evento en el calendario principal
        $calendarId = 'primary';
        $event = $service->events->insert($calendarId, $event);
    
        // Muestra el enlace al evento
        printf('Evento creado: %s\n', $event->htmlLink);
    }

}
