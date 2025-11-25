<?php
header("Content-Type: application/json");
require_once "../../path.php";
require_once BASE_PATH . "/dbConnection.php";
require_once CLASS_PATH . "/User.php";

try {
    if (!isset($_POST["id"])) {
        throw new Exception("Missing ID");
    }

    $id = intval($_POST["id"]);

    $Titles = new User($pdo);
    $deleted = $Titles->deleteTitle($id);

    if (!$deleted) throw new Exception("Delete failed");

    echo json_encode([
        "status" => "success",
        "id" => $id
    ]);
} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}
