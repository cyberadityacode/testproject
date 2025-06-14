<?php

require_once __DIR__ . '/../models/TaskModel.php';

class TaskController
{
    public static function handle($conn, $method, $userId)
    {
        $input = json_decode(file_get_contents('php://input'), true);

        $taskId = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : null;

        switch ($method) {
            case 'GET':
                if ($taskId) {
                    $task = TaskModel::getOne($conn, $taskId, $userId);
                    echo json_encode($task);
                } else {
                    $tasks = TaskModel::getAll($conn, $userId);
                    echo json_encode($tasks);
                }
                break;

            case 'POST':
                $newId = TaskModel::create($conn, $userId, $input);
                echo json_encode([
                    "status" => "success",
                    "message" => "Task Created",
                    "task_id" => $newId
                ]);
                break;

            case 'PUT':
                if (!$taskId) {
                    http_response_code(400);
                    echo json_encode([
                        "status" => "error",
                        "message" => "Task ID is Required"
                    ]);
                    break;
                }
                TaskModel::update($conn, $taskId, $userId, $input);
                echo json_encode([
                    "status" => "success",
                    "message" => "Task Updated"
                ]);
                break;

            case 'DELETE':
                if (!$taskId) {
                    http_response_code(400);
                    echo json_encode([
                        "status" => "error",
                        "message" => "Task ID is Required"
                    ]);
                    break;
                }
                TaskModel::delete($conn, $taskId, $userId);
                echo json_encode([
                    "status" => "success",
                    "message" => "Task Deleted"
                ]);
                break;

            default:
                http_response_code(405);
                echo json_encode([
                    "status" => "error",
                    "message" => "Method Not Allowed"
                ]);

        }

    }
}