<?php
header('Content-Type: application/json');
require_once "../../path.php";
require_once BASE_PATH . "/dbConnection.php";
require_once CLASS_PATH . "/User.php";

try {
    if (!isset($_POST['title'])) throw new Exception("Missing title");
    $title = trim($_POST['title']);
    if ($title === "") throw new Exception("Title cannot be empty");

    $user = new User($pdo);
    $lastId = $user->addTitle($title);

    echo json_encode([
        "status" => "success",
        "data" => [
            "id" => $lastId,
            "title" => $title
        ]
    ]);
} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}
