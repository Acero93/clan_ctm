<?php

use Controllers\ClientController;

// Cargar el controlador
$clientController = new ClientController();

// Obtener todos los clientes
Flight::route('GET /clients', [$clientController, 'getAllClients']);

// Obtener un cliente por ID
Flight::route('GET /client/@id', [$clientController, 'getClientById']);

// Crear o actualizar un cliente
Flight::route('POST /client/save', [$clientController, 'saveClient']);

// Eliminar un cliente
Flight::route('DELETE /client/delete/@id', [$clientController, 'deleteClient']);
