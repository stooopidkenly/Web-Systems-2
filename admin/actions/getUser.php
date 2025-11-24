<?php
header('Content-Type: application/json');
require_once "../path.php";
require_once CLASS_PATH . "/User.php";
require_once BASE_PATH . "/dbConnection.php";

try {
    $user = new User($pdo);
    $info = $user->showInfo();

    echo json_encode([
        "status" => "success",
        "data" => $info
    ]);
} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}
