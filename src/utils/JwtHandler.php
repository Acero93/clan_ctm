<?php
namespace Utils;

use  Firebase\JWT\JWT;
use  Firebase\JWT\Key;

class JwtHandler {
    private static $secretKey = 'your_secret_key'; // Cambia esto por una clave secreta

    // Codificar el token
    public static function encode($data) {
        $issuedAt = time();
        $expirationTime = $issuedAt + 3600;  // El token expirará en una hora
        $payload = array(
            'iat' => $issuedAt,
            'exp' => $expirationTime,
            'data' => $data
        );
    
        // Añadir el algoritmo como tercer parámetro en encode
        return JWT::encode($payload, self::$secretKey, 'HS256'); // 'HS256' es el algoritmo
    }

    // Decodificar el token
    // public static function decode($token) {
    //     try {
    //         $decoded = JWT::decode($token, new key (self::$secretKey, 'HS256'));
    //         return (array) $decoded->data;
    //     } catch (Exception $e) {
    //         return null;
    //     }
    // }

    public static function decode($token) {
        try {
            $decoded = JWT::decode($token, new Key(self::$secretKey, 'HS256'));
            return (array) $decoded->data;
        } catch (\Firebase\JWT\ExpiredException $e) {
            // Token expirado
            return null;
        } catch (\Exception $e) {
            // Otras excepciones (token inválido, etc.)
            return null;
        }
    }

}
