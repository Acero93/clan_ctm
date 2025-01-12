<?php


// require_once __DIR__ . '/../vendor/autoload.php';

require_once 'vendor/autoload.php';


// Configuración inicial
// require_once __DIR__ . '/../src/config/init.php';

// include __DIR__ . '/../src/routes/api.php';
// include __DIR__ . '/../src/routes/views.php';
// Ejecutar la aplicación



require_once 'src/config/init.php';

include 'src/routes/api.php';
include 'src/routes/views.php';

Flight::start();


