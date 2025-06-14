<?php


// CORS headers for local development
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Handle preflight
if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    http_response_code(200);
    exit();
}

require_once '../config/db.php';
require_once '../controllers/AuthController.php';

$data = json_decode(file_get_contents('php://input'), true);

if (!$data || !isset($data['username']) || !isset($data['password'])) {
    echo json_encode([
        "status" => "error",
        "message" => "Missing Fields"
    ]);
    exit();
}

$db = new Database();
$conn = $db->connect();

$response = AuthController::login($conn, $data['username'], $data['password']);
echo json_encode($response);