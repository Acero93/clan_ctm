<?php

namespace Models;
require_once __DIR__ . '/../../libs/rb.php';

class EventModel {

    // Obtener todos los eventos
    public static function getAll() {
        // return \R::findAll('events');

        $sql = "
            SELECT * 
            FROM events 
            ORDER BY 
                CASE 
                    WHEN status = 'Programado' THEN 1 
                    ELSE 2 
                END, 
                status;
        ";
        
        // Ejecuta la consulta y devuelve los resultados
        return \R::getAll($sql);


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
        $event->status              = $data['status'] ?? 'Programado';
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

    public static function attendance($data){

        if($data['id'] != 0){
            $event = \R::load('events', $data['id']);
        }else{
            return false;
        }


        $id_evento = $event->id;

        // print_r($event);

        // $player = \R::load('players', $data['player_id']);


        // Construir la consulta dinámicamente
        $conditions = [];
        $bindings   = [];

        // Verificar si in_game_name está en $data y no está vacío
        if (!empty($data['in_game_name'])) {
            $conditions[] = '(in_game_name = :in_game_name)';
            $bindings[':in_game_name'] = $data['in_game_name'];
        }

        // Verificar si game_id está en $data y no está vacío
        if (!empty($data['game_id'])) {
            $conditions[] = '(game_id = :game_id)';
            $bindings[':game_id'] = $data['game_id'];
        }


        // Asegurarse de que al menos uno de los dos (in_game_name o game_id) esté presente
        if (empty($conditions)) {
            return("Se requiere al menos in_game_name o game_id.");
        }

        // Agregar la condición del PIN
        $bindings[':pin'] = $data['pin'];

        // Unir todas las condiciones con OR para in_game_name y game_id
        $query = implode(' OR ', $conditions);
        $query = "($query) AND pin = :pin"; // Asegurar que el PIN sea correcto

        // print_r($query);

        // Buscar el jugador en la base de datos
        $player = \R::findOne('players', $query, $bindings);


        // var_dump($player);
     

        if (!$player) {

            return [
                "error" => true,
                "message" => "No se encontró ningúno jugador con los datos proporcionados o el PIN es incorrecto."
            ];
        }

        $query      = "event_id = :event_id AND player_id = :player_id";
        $bindings   = [
            ':event_id' => $id_evento,
            ':player_id' => $player->id
        ];
        
        // Busca un registro en la tabla `event_attendance`
        $playerConfirm = \R::findOne('event_attendance', $query, $bindings);
        
        if (isset($playerConfirm->id)) {
            // El jugador ya confirmó su asistencia

            if($playerConfirm->confirm == false){
                return ([
                    "error" => true,
                    "message" => "El jugador ya confirmó su inasistencia."
                ]);
            }

            if($playerConfirm->confirm == true){
                return ([
                    "error" => true,
                    "message" => "El jugador ya confirmó su asistencia."
                ]);
            }
        }

        $attendance     = \R::load('event_attendance', $data['id']); 
        $attendance->player_id = $player->id;
        $attendance->event_id  = $id_evento;
        $attendance->confirm   = $data['confirmado'];
        $attendance->comment   = $data['motivo'];



        if($data['confirmado'] == true){
            $event->actual_attendance   = $event->actual_attendance + 1; 
            $event->updated_at          = date('Y-m-d H:i:s');
        }

        \R::store($event);

        return ([
            "error" => false,
            "message" => \R::store($attendance)
        ]);
    

    }
}