<?php

require_once '../utils/jwt_helper.php';

$header = getallheaders();

if (!isset($header['Authorization'])) {
    http_response_code(401);
    echo json_encode([
        "status" => "error",
        "message" => "Token Requireed"
    ]);
    exit();
}

$token = str_replace("Bearer ", "", $header['Authorization']);
$decoded = JWTHelper::verifyToken($token);

if (!$decoded) {
    http_response_code(403);
    echo json_encode([
        "status" => "error",
        "message" => "Invalid or Expired Token"
    ]);
    exit();
}


// Pass user info to next script
$_USER = $decoded;