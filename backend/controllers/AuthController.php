<?php

require_once __DIR__ . '/../utils/jwt_helper.php';

class AuthController
{
    // Register Function

    public static function register($conn, $username, $email, $password)
    {
        try {
            // Check if username or email exists

            $stmt = $conn->prepare("SELECT user_id FROM users WHERE username=:username OR email=:email");

            $stmt->execute([
                ":username" => $username,
                ":email" => $email
            ]);

            if ($stmt->rowCount() > 0) {
                return [
                    "status" => "error",
                    "message" => "username or email already registered"
                ];
            }

            // Hash the password

            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Insert new User

            $stmt = $conn->prepare("INSERT INTO users(username, email, password_hash) VALUES(:username,:email,:password_hash)");


            $stmt->execute([
                ":username" => $username,
                ":email" => $email,
                ":password_hash" => $hashedPassword
            ]);

            return [
                "status" => "success",
                "message" => "User Registered Successfully"
            ];

        } catch (PDOException $e) {
            return [
                "status" => "error",
                "message" => "Database Error: " . $e->getMessage()
            ];
        }
    }

    // Login Function

    public static function login($conn, $username, $password)
    {
        try {
            $stmt = $conn->prepare("SELECT * FROM users WHERE username=:username");

            $stmt->execute([':username' => $username]);

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user) {
                return [
                    "status" => "error",
                    "message" => "User Not Found"
                ];
            }

            if (!password_verify($password, $user['password_hash'])) {
                return [
                    "status" => "error",
                    "message" => "Incorrect Password"
                ];
            }

            // Create Payload for JWT

            $payload = [
                "id" => $user['user_id'],
                "email" => $user['email'],
                "username" => $user['username'],
                "iat" => time(),
                "exp" => time() + 3600
            ];

            $token = JWTHelper::generateToken($payload);

            return [
                "status" => "success",
                "token" => $token,
                "user" => [
                    "id" => $user['user_id'],
                    "username" => $user['username'],
                    "email" => $user["email"]
                ]
            ];




        } catch (PDOException $e) {
            return [
                "status" => "error",
                "message" => "Database Error" . $e->getMessage()
            ];
        }
    }
}