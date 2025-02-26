<?php

use Controllers\EventController;
use Controllers\CalendarController;
// Cargar el controlador
$EventController = new EventController();
$CalendarController = new CalendarController();


Flight::route('GET /events', [$EventController, 'getAll']);

Flight::route('GET /events/@id', [$EventController, 'getById']);

Flight::route('POST /events/save', [$EventController, 'save']);

Flight::route('DELETE /events/delete/@id', [$EventController, 'delete']);

Flight::route('POST /events/confirm', [$EventController, 'attendance']);


Flight::route('/calendarAuth', [$CalendarController, 'CalendarAuth']);
Flight::route('/callbackcalendar', [$CalendarController, 'CalendarInit']);
Flight::route('/createEvent', [$CalendarController, 'CreateEvent']);