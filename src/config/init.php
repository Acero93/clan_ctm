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
require_once __DIR__ . '/../../libs/rb.php'; // Asegúrate de que la ruta a rb.php sea correcta

R::setup("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);

// Verificar si la conexión fue exitosa
if (!R::testConnection()) {
    die('No se pudo conectar a la base de datos.');
}