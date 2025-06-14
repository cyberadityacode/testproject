<?php

require_once __DIR__ . "/../utils/jwt_helper.php";

$header = getallheaders();

if (!isset($header['Authorization'])) {
    http_response_code(401);
    echo json_encode([
        "status" => "error",
        "message" => "Missing Token"
    ]);
    exit();
}

$token = str_replace("Bearer ", "", $header['Authorization']);
$user = JWTHelper::verifyToken($token);

if (!$user) {
    http_response_code(401);
    echo json_encode([
        "status" => "error",
        "message" => "Invalid or Expired Token"
    ]);
    exit();
}

// now available globally in a route

$_USER_ID = $user->id;