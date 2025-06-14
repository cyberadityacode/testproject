<?php

class TaskModel
{
    public static function getAll($conn, $userId)
    {
        $stmt = $conn->prepare("SELECT * FROM tasks WHERE created_by=:uid");
        $stmt->execute(['uid' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getOne($conn, $taskId, $userId)
    {
        $stmt = $conn->prepare('SELECT * FROM tasks WHERE task_id=:id AND created_by=:uid');
        $stmt->execute(['id' => $taskId, 'uid' => $userId]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($conn, $userId, $data)
    {
        $stmt = $conn->prepare("INSERT INTO tasks(task_name, status_id, created_by, updated_by) VALUES(:name,:status,:created_by,:updated_by)");
        $stmt->execute([
            'name' => $data['task_name'],
            'status' => $data['status_id'],
            'created_by' => $userId,
            'updated_by' => $userId
        ]);

        return $conn->lastInsertId();
    }

    public static function update($conn, $taskId, $userId, $data)
    {
        $stmt = $conn->prepare("UPDATE tasks SET task_name = :name, status_id =:status, updated_by=:uid WHERE task_id = :id AND created_by=:uid");

        return $stmt->execute([
            'name' => $data['task_name'],
            'status' => $data['status_id'],
            'uid' => $userId,
            'id' => $taskId
        ]);
    }

    public static function delete($conn, $taskId, $userId)
    {
        $stmt = $conn->prepare("DELETE FROM tasks WHERE task_id= :id AND created_by=:uid");
        return $stmt->execute([
            'id' => $taskId,
            'uid' => $userId
        ]);
    }
}