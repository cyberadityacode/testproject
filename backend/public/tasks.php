<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Authorization, Content-Type");

if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    http_response_code(200);
    exit();
}

require_once __DIR__ . "/../config/db.php";
require_once __DIR__ . "/../middlewares/verify_token.php";
require_once __DIR__ . "/../controllers/TaskController.php";

$db = new Database();
$conn = $db->connect();
TaskController::handle($conn, $_SERVER["REQUEST_METHOD"], $_USER_ID);