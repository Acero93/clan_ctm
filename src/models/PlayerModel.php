<?php

namespace Models;
// require_once __DIR__ . '/../../libs/rb.php';

class PlayerModel {

    public static function getAll($table) {
        return \R::findAll($table);
    }

    // Obtener un cliente por ID
    public static function getById($table,$id) {
        return \R::load($table, $id);
    }

    // Crear o actualizar un cliente
    // public static function save($data) {
    //     $member = \R::load('members', $data['id'] ?? 0);
    //     $member->first_name     = $data['first_name'];
    //     $member->last_name      = $data['last_name'];
    //     $member->phone_number   = $data['phone_number'];
    //     $member->address        = $data['address'];
    //     $member->attributes     = json_encode($data['attributes']); // JSON o string dependiendo del uso
    //     $member->status         = $data['status'];
    //     $member->updated_at     = date('Y-m-d H:i:s');

    //     if (empty($data['id'])) { // Verifica si no está definido o es falso (0, null, etc.)
    //         $member->created_at = date('Y-m-d H:i:s');
    //     }
        
    //     return \R::store($member);
    // }

    public static function save($table,$data) {
        // Cargar el modelo existente o crear uno nuevo
        $model = \R::load($table, $data['id'] ?? 0);
    
        // Iterar sobre los datos y asignarlos al modelo
        foreach ($data as $key => $value) {
            // Evitar asignar el 'id' directamente, ya que es manejado por \R::load
            if ($key !== 'id') {
                // Si el campo es 'attributes' y es un array, lo codificamos a JSON
                if ($key === 'attributes' && is_array($value)) {
                    $model->$key = json_encode($value);
                } else {
                    $model->$key = $value;
                }
            }
        }
    
        // Establecer las fechas de creación y actualización
        $model->updated_at = date('Y-m-d H:i:s');
        if (empty($data['id'])) {
            $model->created_at = date('Y-m-d H:i:s');
        }
    
        // Guardar el modelo y devolver el ID
        return \R::store($model);
    }

    // Eliminar un cliente
    public static function delete($table,$id) {
        $member = \R::load($table, $id);
        if ($member->id) {
            \R::trash($member);
            return true;
        }
        return false;
    }
}
