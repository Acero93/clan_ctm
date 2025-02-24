<?php

use Controllers\EventController;

// Cargar el controlador
$EventController = new EventController();


Flight::route('GET /events', [$EventController, 'getAll']);

Flight::route('GET /events/@id', [$EventController, 'getById']);

Flight::route('POST /events/save', [$EventController, 'save']);

Flight::route('DELETE /events/delete/@id', [$EventController, 'delete']);

Flight::route('POST /events/confirm', [$EventController, 'attendance']);