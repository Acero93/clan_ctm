<?php

use Controllers\ClientController;

// Cargar el controlador
$clientController = new ClientController();

// Obtener todos los clientes
Flight::route('GET /members', [$clientController, 'getAllMembers']);

// Obtener un cliente por ID
Flight::route('GET /member/@id', [$clientController, 'getClientById']);

// Crear o actualizar un cliente
Flight::route('POST /member/save', [$clientController, 'saveClient']);

// Eliminar un cliente
Flight::route('DELETE /member/delete/@id', [$clientController, 'deleteClient']);
