<?php

namespace Models;
require_once __DIR__ . '/../../libs/rb.php';

class EventModel {

    // Obtener todos los eventos
    public static function getAll() {
        return \R::findAll('events');
    }

    // Obtener un evento por ID
    public static function getById($id) {
        return \R::load('events', $id);
    }

    // Crear o actualizar un evento
    public static function save($data) {
        $event = \R::load('events', $data['id'] ?? 0);
        $event->name                = $data['name'];
        $event->description         = $data['description'];
        $event->event_type          = $data['event_type'];
        $event->event_date          = $data['event_date'];
        $event->server_ip           = $data['server_ip'];
        $event->expected_attendance = $data['expected_attendance'];
        $event->actual_attendance   = $data['actual_attendance'] ?? 0; // Valor predeterminado si no se proporciona
        $event->status              = $data['status'] ?? 1;
        $event->updated_at          = date('Y-m-d H:i:s');

        if (empty($data['id'])) { // Verifica si no está definido o es falso (0, null, etc.)
            $event->created_at = date('Y-m-d H:i:s');
        }

        return \R::store($event);
    }

    // Eliminar un evento
    public static function delete($id) {
        $event = \R::load('events', $id);
        if ($event->id) {
            \R::trash($event);
            return true;
        }
        return false;
    }
}