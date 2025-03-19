<?php

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../utils/');
$dotenv->load();



// Acceder a las VariablesW
$dbHost = $_ENV['DB_HOST'];
$dbName = $_ENV['DB_NAME'];
$dbUser = $_ENV['DB_USER'];
$dbPassword = $_ENV['DB_PASSWORD'];


// Configurar la conexión de RedBeanPHP
require_once __DIR__ . '/../utils/rb.php'; // Asegúrate de que la ruta a rb.php sea correcta


if (!R::testConnection()) {
    R::setup("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);
}

