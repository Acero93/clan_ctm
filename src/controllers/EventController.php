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
}
