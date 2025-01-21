<?php

namespace Controllers;
use Models\MemberModel;
use Flight;


class MemberController {

    // Obtener todos los clientes
    public function getAllMembers() {
        $members = MemberModel::getAll();
        Flight::json($members);
    }

    // Obtener un cliente por ID
    public function getMemberById($id , $api = true) {
        $member = MemberModel::getById($id);
        if ($member->id) {
            if (!$api) {
                return $member->export();
            }

            Flight::json($member);

        } else {
            Flight::halt(404, json_encode([ "success" => false, "status" => "error","message" => "No encontrado"]));
        }
    }

    // Crear o actualizar un cliente
    public function saveMember() {
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
