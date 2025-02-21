<?php

namespace Controllers;
// use Models\ClientModel;
use Flight;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;


class HLLController {


    private $token;

    public function __construct() {
        $this->token = $_ENV['TOKEN'];
    }

    public function getSvStatus () {


        $data = Flight::request()->data;
        $id_sv = $data["id_sv"];

        $url = "http://server{$id_sv}.rconctm.xyz/api/get_public_info";
        $response = file_get_contents($url);
        
        if ($response !== false) {
            Flight::json(["success" => true, "status" => "success","message" => json_decode($response,true)]);
        }

    }


    // public function getServerData () {
    //     $data       = Flight::request()->data;
    //     $endpoint   = $data["endpoint"];
    //     $url        = "{$endpoint}/api/get_public_info";
    //     $response   = file_get_contents($url);
        
    //     if ($response !== false) {
    //         Flight::json(["success" => true, "status" => "success","message" => json_decode($response,true)]);
    //     }

    // }


    public function getServerData() {
        // Obtener los datos de la solicitud
        $data = Flight::request()->data;
        $endpoint = $data["endpoint"];
        $url = "{$endpoint}/api/get_public_info";
    
        // Crear un cliente Guzzle
        $client = new Client();
    
        try {
            // Realizar la solicitud GET
            $response = $client->get($url);
    
            // Obtener el cuerpo de la respuesta
            $responseBody = $response->getBody()->getContents();
    
            // Devolver una respuesta exitosa
            Flight::json([
                "success" => true,
                "status" => "success",
                "message" => json_decode($responseBody, true)
            ]);
        } catch (RequestException $e) {
            // Manejar errores de la solicitud
            if ($e->hasResponse()) {
                $errorResponse = $e->getResponse()->getBody()->getContents();
                Flight::json([
                    "success" => false,
                    "status" => "error",
                    "message" => json_decode($errorResponse, true)
                ]);
            } else {
                Flight::json([
                    "success" => false,
                    "status" => "error",
                    "message" => "Error al conectar con el servidor: " . $e->getMessage()
                ]);
            }
        }
    }

    public function getPlayerList ($raw  = false) {

        $data       =  Flight::request()->data;
        $endpoint   = $data["endpoint"] . "/api/get_players";
        
        // Crear un contexto con el encabezado Authorization
        $options    = [
            "http" => [
                "header" => "Authorization: Bearer $this->token\r\n"
            ]
        ];
        
        $context = stream_context_create($options);
        
        // Realizar la solicitud con el contexto
        $response = file_get_contents($endpoint, false, $context);


        if ($raw) {
            return $response;
        }

        
        if ($response !== false) {
            Flight::json([
                "success" => true,
                "status" => "success",
                "message" => json_decode($response, true)
            ]);
        } else {
            Flight::json([
                "success" => false,
                "status" => "error",
                "message" => "No se pudo obtener la respuesta del servidor"
            ]);
        }
        

    }

    public function kickPlayer( $player_name = null, $raw = false) {
        // Obtener los datos de la solicitud
        $data       = Flight::request()->data;
        $endpoint   = $data["endpoint"] . "/api/kick";
    
        // Crear el cuerpo de la solicitud en formato JSON
        $jsonData   = [
            "player_name"   => $player_name != null ? $player_name : $data["player_name"],
            "reason"        => $data["message"],
            "by"            => $_ENV['ADMIN']
        ];
    
        $client = new Client();


        try {

            $response = $client->post($endpoint, [
                'headers' => [
                    'Authorization' => "Bearer $this->token",
                    'Content-Type' => 'application/json'
                ],
                'json' => $jsonData 
            ]);

            $responseBody = $response->getBody()->getContents();

            if ($raw) {
                return ;
            }

            Flight::json([
                "success" => true,
                "status" => "success",
                "message" => json_decode($responseBody, true)
            ]);
        } catch (RequestException $e) {
            // Manejar errores de la solicitud
            if ($e->hasResponse()) {
                $errorResponse = $e->getResponse()->getBody()->getContents();
                Flight::json([
                    "success" => false,
                    "status" => "error",
                    "message" => json_decode($errorResponse, true)
                ]);
            } else {
                Flight::json([
                    "success" => false,
                    "status" => "error",
                    "message" => "Error al enviar la solicitud: " . $e->getMessage()
                ]);
            }
        }

    }
    public function kickPlayersNoClan(){
        
        $player_list = json_decode($this->getPlayerList(true),true)['result'];
        $data        =  Flight::request()->data;



        if (count($player_list) == 0) {
            Flight::json([
                "success" => false,
                "status" => "error",
                "message" => "Sin jugadores en el servidor."
            ]);

            return;
        }

        $count = 0;

        array_walk($player_list, function ($player) use (&$count) {
            if (!preg_match('/CTM/i', $player['name'])) {

                $this->kickPlayer($player['name'], true);
                // print_r($player['name'] . " expulsado\n");
                $count++;
            }
        });
        
        Flight::json([
            "success" => true,
            "status" => "success",
            "message" => "Jugadores expulsados: " . $count
        ]);

        // foreach ($player_list as $player) {






        //     // $this->kickPlayer([
        //     //     "endpoint"  => Flight::request()->data["endpoint"],
        //     //     "player_id" => $player["id"],
        //     //     "reason"    => "Preparando ntrenamiento clan CTM, Vuelve a conectarte en otra oportunidad :)!",
        //     //     "by"        => Flight::request()->data["by"]
        //     // ]);
        // }



        
    }

    public function tempBanPlayer(){

        $data       = Flight::request()->data;
        $endpoint   = $data["endpoint"] . "/api/temp_ban";
        $jsonData = json_encode([
            "player_id"         => $data["player_id"],
            "duration_hours"    => $data["duration_hours"],
            "reason"            => $data["reason"],
            "by"                => $data["by"]
        ]);


        // Crear un contexto con el encabezado Authorization
        $options = [
            "http" => [
                "method" => "POST", // Método POST
                "header" => implode("\r\n", [
                    "Authorization: Bearer $this->token",
                    "Content-Type: application/json", // Indicar que el cuerpo es JSON
                    "Content-Length: " . strlen($jsonData) // Longitud del cuerpo
                ]),
                "content" => $jsonData // Cuerpo de la solicitud
            ]
        ];

        // Crear el contexto de la solicitud
        $context = stream_context_create($options);

        // Enviar la solicitud y obtener la respuesta
        $response = file_get_contents($endpoint, false, $context);

        // Manejar la respuesta
        if ($response === FALSE) {
            // Error en la solicitud
            Flight::json([
                "success" => false,
                "status" => "error",
                "message" => "Error al enviar la solicitud."
            ]);
        } else {
            // Éxito
            Flight::json([
                "success" => true,
                "status" => "success",
                "message" => json_decode($response, true)
            ]);
        }



        // "arguments": {
        //     "player_name": {
        //         "default": "None",
        //         "annotation": "str | None"
        //     },
        //     "player_id": {
        //         "default": "None",
        //         "annotation": "str | None"
        //     },
        //     "duration_hours": {
        //         "default": "2",
        //         "annotation": "<class 'int'>"
        //     },
        //     "reason": {
        //         "default": "",
        //         "annotation": "<class 'str'>"
        //     },
        //     "by": {
        //         "default": "",
        //         "annotation": "<class 'str'>"
        //     }
        // }

    }


    public function changeMap(){

        $data = Flight::request()->data;
        $endpoint = $data["endpoint"] . "/api/set_map";
        $map = $data["map"]; // El mapa que deseas enviar (por ejemplo, "omaha_warfare_day")
        
        
        // Crear el cuerpo de la solicitud en formato JSON
        $jsonData = json_encode([
            "map" => $map // Enviamos el mapa en el cuerpo de la solicitud
        ]);
        
        // Configurar las opciones para la solicitud HTTP
        $options = [
            "http" => [
                "method" => "POST", // Método POST
                "header" => implode("\r\n", [
                    "Authorization: Bearer $this->token",
                    "Content-Type: application/json", // Indicar que el cuerpo es JSON
                    "Content-Length: " . strlen($jsonData) // Longitud del cuerpo
                ]),
                "content" => $jsonData // Cuerpo de la solicitud
            ]
        ];
        
        // Crear el contexto de la solicitud
        $context = stream_context_create($options);
        
        // Enviar la solicitud y obtener la respuesta
        $response = file_get_contents($endpoint, false, $context);
        
        // Manejar la respuesta
        if ($response === FALSE) {
            // Error en la solicitud
            Flight::json([
                "success" => false,
                "status" => "error",
                "message" => "Error al enviar la solicitud."
            ]);
        } else {
            // Éxito
            Flight::json([
                "success" => true,
                "status" => "success",
                "message" => json_decode($response, true)
            ]);
        }

        
        // {
        //     "map_name" : "elalamein_warfare_night"
        // }
        
    }


    // public function sendBroadcastMessage(){


    //     // "endpoint": "message_player",
    //     // "arguments": {
    //     //     "player_name": {
    //     //         "default": "None",
    //     //         "annotation": null
    //     //     },
    //     //     "player_id": {
    //     //         "default": "None",
    //     //         "annotation": null
    //     //     },
    //     //     "message": {
    //     //         "default": "",
    //     //         "annotation": "<class 'str'>"
    //     //     },
    //     //     "by": {
    //     //         "default": "",
    //     //         "annotation": "<class 'str'>"
    //     //     },
    //     //     "save_message": {
    //     //         "default": "False",
    //     //         "annotation": "<class 'bool'>"
    //     //     }
    //     // }



    //     $data       = Flight::request()->data;
    //     $endpoint   = $data["endpoint"] . "/api/message_player";
    //     $message    = $data["message"];
    //     $player_id  = $data["player_id"];
        
    //     // Crear el cuerpo de la solicitud en formato JSON
    //     $jsonData   = json_encode([
    //         "message" => $message, 
    //         "player_id" => $player_id, 
    //         "by" => "Acero93"  
    //     ]);

    //     // Configurar las opciones para la solicitud HTTP
    //     $options = [
    //         "http" => [
    //             "header" => implode("\r\n", [
    //                 "Authorization: Bearer $this->token",
    //                 "Content-Type: application/json", // Indicar que el cuerpo es JSON
    //                 "Content-Length: " . strlen($jsonData) // Longitud del cuerpo
    //             ]),
    //             "body" => $jsonData // Cuerpo de la solicitud
    //         ]
    //     ];
        
    //     // Crear el contexto de la solicitud
    //     $context    = stream_context_create($options);
    //     $response   = file_get_contents($endpoint, false, $context);
        

    //     if ($response === FALSE) {
    //         Flight::json([
    //             "success" => false,
    //             "status" => "error",
    //             "message" => "Error al enviar la solicitud."
    //         ]);
    //     } else {
    //         Flight::json([
    //             "success" => true,
    //             "status" => "success",
    //             "message" => json_decode($response, true)
    //         ]);
    //     }   

    // }

    public function sendBroadcastMessage() {
        // Obtener los datos de la solicitud
        $data = Flight::request()->data;
        $endpoint = $data["endpoint"] . "/api/message_player";
        $message = $data["message"];
        $player_id = $data["player_id"];
    
        // Crear el cuerpo de la solicitud en formato JSON
        $jsonData = json_encode([
            "message" => $message,
            "player_id" => $player_id,
            "by" => "Acero93",
            "save_message" => false // Añadir este campo si es necesario
        ]);
    
        // Crear un cliente Guzzle
        $client = new Client();
    
        try {
            // Enviar la solicitud POST con Guzzle
            $response = $client->post($endpoint, [
                'headers' => [
                    'Authorization' => "Bearer $this->token",
                    'Content-Type' => 'application/json',
                    'Content-Length' => strlen($jsonData)
                ],
                'body' => $jsonData
            ]);
    
            // Obtener el cuerpo de la respuesta
            $responseBody = $response->getBody()->getContents();
    
            // Devolver una respuesta exitosa
            Flight::json([
                "success" => true,
                "status" => "success",
                "message" => json_decode($responseBody, true)
            ]);
        } catch (RequestException $e) {
            // Manejar errores de la solicitud
            if ($e->hasResponse()) {
                $errorResponse = $e->getResponse()->getBody()->getContents();
                Flight::json([
                    "success" => false,
                    "status" => "error",
                    "message" => json_decode($errorResponse, true)
                ]);
            } else {
                Flight::json([
                    "success" => false,
                    "status" => "error",
                    "message" => "Error al enviar la solicitud: " . $e->getMessage()
                ]);
            }
        }
    }

    public function sendMasiveBroadcastMessage() {
        $data = Flight::request()->data;
        $endpoint = $data["endpoint"] . "/api/message_player";
        $message = $data["message"];
    
        // Obtener la lista de jugadores
        $player_list = json_decode($this->getPlayerList(true), true)["result"];
    
        // Crear un cliente Guzzle
        $client = new Client();
    
        // Crear un array de promesas (solicitudes asíncronas)
        $promises = [];
        foreach ($player_list as $player) {
            $jsonData = json_encode([
                "message" => $message,
                "player_id" => $player["player_id"],
                "by" => "Acero93"
            ]);
    
            $promises[] = $client->postAsync($endpoint, [
                'headers' => [
                    'Authorization' => "Bearer $this->token",
                    'Content-Type' => 'application/json',
                    'Content-Length' => strlen($jsonData)
                ],
                'body' => $jsonData
            ]);
        }
    
        // Esperar a que todas las promesas se resuelvan
        $responses = Promise\Utils::settle($promises)->wait();
    
        // Manejar la respuesta final
        $lastResponse = end($responses);
        if ($lastResponse['state'] !== 'fulfilled') {
            Flight::json([
                "success" => false,
                "status" => "error",
                "message" => "Error al enviar la solicitud."
            ]);
        } else {
            Flight::json([
                "success" => true,
                "status" => "success",
                "message" => json_decode($lastResponse['value']->getBody(), true)
            ]);
        }
    }
}