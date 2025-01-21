<?php

namespace Models;
require_once __DIR__ . '/../../libs/rb.php';

class MemberModel {

    // Obtener todos los clientes
    public static function getAll() {
        return \R::findAll('members');
    }

    // Obtener un cliente por ID
    public static function getById($id) {
        return \R::load('members', $id);
    }

    // Crear o actualizar un cliente
    public static function save($data) {
        $member = \R::load('members', $data['id'] ?? 0);
        $member->first_name     = $data['first_name'];
        $member->last_name      = $data['last_name'];
        $member->phone_number   = $data['phone_number'];
        $member->address        = $data['address'];
        $member->attributes     = json_encode($data['attributes']); // JSON o string dependiendo del uso
        $member->status         = $data['status'];
        $member->updated_at     = date('Y-m-d H:i:s');

        if (empty($data['id'])) { // Verifica si no está definido o es falso (0, null, etc.)
            $member->created_at = date('Y-m-d H:i:s');
        }
        
        return \R::store($member);
    }

    // Eliminar un cliente
    public static function delete($id) {
        $member = \R::load('members', $id);
        if ($member->id) {
            \R::trash($member);
            return true;
        }
        return false;
    }
}
