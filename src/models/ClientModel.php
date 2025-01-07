<?php

namespace Models;
require_once __DIR__ . '/../../libs/rb.php';

class ClientModel {

    // Obtener todos los clientes
    public static function getAll() {
        return \R::findAll('clients');
    }

    // Obtener un cliente por ID
    public static function getById($id) {
        return \R::load('clients', $id);
    }

    // Crear o actualizar un cliente
    public static function save($data) {
        $client = \R::load('clients', $data['id'] ?? 0);
        $client->first_name     = $data['first_name'];
        $client->last_name      = $data['last_name'];
        $client->phone_number   = $data['phone_number'];
        $client->address        = $data['address'];
        $client->attributes     = json_encode($data['attributes']); // JSON o string dependiendo del uso
        $client->status         = $data['status'];
        $client->updated_at     = date('Y-m-d H:i:s');

        if (empty($data['id'])) { // Verifica si no está definido o es falso (0, null, etc.)
            $client->created_at = date('Y-m-d H:i:s');
        }
        
        return \R::store($client);
    }

    // Eliminar un cliente
    public static function delete($id) {
        $client = \R::load('clients', $id);
        if ($client->id) {
            \R::trash($client);
            return true;
        }
        return false;
    }
}
