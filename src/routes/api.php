<?php


use Utils\JwtHandler;
use Firebase\JWT\JWT;


//require "web.php";
//require "MemberApi.php";
//require "HLLServerApi.php";
//require "CTMWebAPI.php";
require "EventsApi.php";


Flight::route('POST /auth', function() {
    // Obtener datos del cuerpo de la solicitud (por ejemplo, email y password)
    $data = json_decode(Flight::request()->getBody(), true);

    // Verificar si los datos fueron decodificados correctamente
    if (json_last_error() !== JSON_ERROR_NONE) {
        Flight::halt(400, json_encode(["message" => "Invalid JSON format"]));
    }

    // Verificar si los campos 'email' y 'password' están presentes
    if (!isset($data['email']) || !isset($data['password'])) {
        Flight::halt(400, json_encode(["message" => "Email and password are required"]));
    }

    // Validar las credenciales (esto puede ser más complejo dependiendo de tu lógica)
    if ($data['email'] == $_ENV['USERNAME'] && $data['password'] == $_ENV['PASSWORD']) {
        // Aquí normalmente validas contra tu base de datos
        $user = [
            "id" => 1,
            "email" => $data['email'],
            "name" => "Amodoritos con queso"
        ];

        // Genera el token JWT
        $key = "your_secret_key"; // Clave secreta
        $token = JwtHandler::encode($user);

        // Almacenar el token en la sesión PHP
        session_start();
        $_SESSION['jwt_token'] = $token;


        // Devuelve el mensaje de login exitoso con la ruta protegida
        Flight::json(["message" => "Login exitoso", "path" => "/base", "token" => $token]);
    } else {
        // Credenciales incorrectas
        Flight::halt(401, json_encode(["message" => "Credenciales incorrectas"]));
    }
});

Flight::route('GET /logout', function() {
    // Iniciar la sesión para acceder a las variables de sesión
    session_start();

    // Eliminar el token JWT de la sesión
    if (isset($_SESSION['jwt_token'])) {
        unset($_SESSION['jwt_token']);
    }

    // Opcional: Destruir toda la sesión
    session_destroy();

    // Responder al cliente indicando que el logout fue exitoso
    // Flight::json(["message" => "Logout exitoso"]);
    Flight::render('login.php', ['title' => 'Login del amor']);
}); 


// Flight::before('start', function() {
//     // Las rutas que no requieren verificación de token
//     $allowedRoutes = [
//         '/get_hll_sv_status',
//         '/auth', 
//         '/login',
//         '/',
//         '/uranium',
//         '/miembros',
//         '/events',
//         '/events/confirm',
//         '/eventos/asistencia'
//     ];

//     $currentRoute = Flight::request()->url;

//     if (in_array($currentRoute, $allowedRoutes)) {
//         return;  
//     }

//     session_start();
 
    
//     if (!isset($_SESSION['jwt_token'])) {
//         Flight::halt(401, json_encode(["message" => "Falta token"]));
//     }

//     $token = $_SESSION['jwt_token'];
//     $userData = JwtHandler::decode($token);

//     if (!$userData) {
//         Flight::render('login.php', ['title' => 'Login CTM']);
//     }

//     Flight::set('user', $userData);
// });
