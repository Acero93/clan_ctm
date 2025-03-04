<?php

use Controllers\PlayerController;

// Cargar el controlador
$playerController = new PlayerController('players');

// Obtener todos los clientes
Flight::route('GET /players', [$playerController, 'getAll']);

// Obtener un cliente por ID
Flight::route('GET /player/@id', [$playerController, 'getById']);

// Crear o actualizar un cliente
Flight::route('POST /player/save', [$playerController, 'save']);

// Eliminar un cliente
Flight::route('DELETE /player/delete/@id', [$playerController, 'delete']);
