<?php

namespace Controllers;
use Models\EventModel;
use Flight;


class EventController {

    // Obtener todos los clientes
    public function getAll() {
        $elements = EventModel::getAll();
        Flight::json($elements);
    }

    // Obtener un evento por ID
    public function getById($id , $api = true) {
        $element = EventModel::getById($id);
        if ($element->id) {
            if (!$api) {
                return $element->export();
            }

            Flight::json($element);

        } else {
            Flight::halt(404, json_encode([ "success" => false, "status" => "error","message" => "No encontrado"]));
        }
    }

    // Crear o actualizar un evento
    public function save() {
        $data         = Flight::request()->data->getData();


        switch ($data['event_type']) {
            case '0':
                $data['event_type'] = 'Entrenamiento interno';
                break;
            case '1':
                $data['event_type'] = 'Entrenamiento externo';
                break;
            case '2':
                $data['event_type'] = 'Evento: CvC';
                break;
            case '3':
                $data['event_type'] = 'Evento: Senado';
                break;
            case '4':
                $data['event_type'] = 'Evento: Competitivo';
                break;
        }
        
        $elementId    = EventModel::save($data);
        Flight::json(["success" => true, "status" => "success","message" => "Guardado correctamente", "id" => $elementId]);
    }

    // Eliminar un evento
    public function delete($id) {
        $result = EventModel::delete($id);
        if ($result) {
            Flight::json(["success" => true, "status" => "success","message" => "Eliminado correctamente"]);
        } else {
            Flight::halt(404, json_encode(["message" => "No encontrado"]));
        }
    }


    public function vote(){


        $data       = Flight::request()->data->getData();
        $result     = EventModel::vote($data);
        
        if ($result) {
            Flight::json(["success" => true, "status" => "success", "message" => "Votación enviada"]);
        } else {
            Flight::halt(404, json_encode(["message" => "No encontrado"]));
        }

    }

    public function attendance(){

        $data       = Flight::request()->data->getData();
        if(empty($data['game_id']) && empty($data['in_game_name'])){

            Flight::json(["success" => false, "status" => "error", "message" => "Faltan datos ID del jugador o Nombre en el juego."]); 
            return;
        }

        $result     = EventModel::attendance($data);

        if($result['error']){

            Flight::json(["success" => false, "status" => "error", "message" => $result['message'] ]);
            return;
        }
        
        Flight::json(["success" => true, "status" => "success", "message" =>  $result['message'] ]);

    }

}
