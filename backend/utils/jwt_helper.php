<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require '../vendor/autoload.php';

class JWTHelper
{
    public static $key = "jaimatadi";
    public static $alg = "HS256";

    public static function generateToken($payload)
    {
        return JWT::encode($payload, self::$key, self::$alg);
    }

    public static function verifyToken($token)
    {
        try {
            return JWT::decode($token, new Key(self::$key, self::$alg));
        } catch (Exception $e) {
            return null;
        }
    }
}