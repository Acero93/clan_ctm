<?php

namespace Models;
// require_once __DIR__ . '/../../libs/rb.php';

class TacticalModel {

    // Obtener todos los clientes
    public static function getAll() {
        return \R::findAll('tactics_maps');
    }

    // Obtener un cliente por ID
    public static function getById($id) {
        return \R::load('tactics_maps', $id);
    }

    // Crear o actualizar un cliente
    public static function save($data) {


        $tactical           = \R::load('tactics_maps', $data['id'] ?? 0);
        $tactical->name     = $data['name'] ?? null;
        $tactical->id_event = $data['id_event'] ?? null;
        $tactical->url      = $data['url'] ?? null;
        $tactical->password = $data['password'] ?? null;
        // $tactical->maps_img = $data['maps_img'] ?? null;
    
        // $currentDate = date('Y-m-d H:i:s'); 
        // if (empty($tactical->id)) {
        //     $tactical->create_date = $currentDate;
        // }
        // $tactical->update_date = $currentDate;
    
        $id = \R::store($tactical);
    
        return $id;
    }

    // Eliminar un cliente
    public static function delete($id) {
        $tactical = \R::load('tactics_maps', $id);
        if ($tactical->id) {
            \R::trash($tactical);
            return true;
        }
        return false;
    }




    // manage-bde -status
    // manage-bde -unlock []: -rp recovery key
    // manage-bde -protectors -disable []:
}
