<?php

namespace Controllers;
use Models\ClientModel;
use Flight;


class ClientController {

    // Obtener todos los clientes
    public function getAllClients() {
        $clients = ClientModel::getAll();
        Flight::json($clients);
    }

    // Obtener un cliente por ID
    public function getClientById($id , $api = true) {
        $client = ClientModel::getById($id);
        if ($client->id) {
            if (!$api) {
                return $client->export();
            }

            Flight::json($client);

        } else {
            Flight::halt(404, json_encode([ "success" => false, "status" => "error","message" => "No encontrado"]));
        }
    }

    // Crear o actualizar un cliente
    public function saveClient() {
        $data        = Flight::request()->data->getData();
        $clientId    = ClientModel::save($data);
        Flight::json(["success" => true, "status" => "success","message" => "Guardado correctamente", "id" => $clientId]);
    }

    // Eliminar un cliente
    public function deleteClient($id) {
        $result = ClientModel::delete($id);
        if ($result) {
            Flight::json(["success" => true, "status" => "success","message" => "Eliminado correctamente"]);
        } else {
            Flight::halt(404, json_encode(["message" => "No encontrado"]));
        }
    }
}
