<?php

namespace Controllers;
use Models\PlayerModel;
use Flight;


class PlayerController {
    
    private $table;

    public function __construct($table) {
        $this->table = $table;
    }

    // Obtener todos los clientes
    public function getAll() {
        $players = PlayerModel::getAll($this->table);
        Flight::json($players);
    }

    // Obtener un cliente por ID
    public function getById($id , $api = true) {
        $player = PlayerModel::getById($this->table,$id);
        if ($player->id) {
            if (!$api) {
                return $player->export();
            }

            Flight::json($player);

        } else {
            Flight::halt(404, json_encode([ "success" => false, "status" => "error","message" => "No encontrado"]));
        }
    }

    // Crear o actualizar un cliente
    public function save() {
        $data        = Flight::request()->data->getData();
        $playerId    = PlayerModel::save($this->table,$data);
        Flight::json(["success" => true, "status" => "success","message" => "Guardado correctamente", "id" => $playerId]);
    }

    // Eliminar un cliente
    public function delete($id) {
        $result = PlayerModel::delete($this->table,$id);
        if ($result) {
            Flight::json(["success" => true, "status" => "success","message" => "Eliminado correctamente"]);
        } else {
            Flight::halt(404, json_encode(["message" => "No encontrado"]));
        }
    }
}
