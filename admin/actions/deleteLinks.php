<?php
header('Content-Type: application/json');
require_once "../../path.php";
require_once BASE_PATH . "/dbConnection.php";
require_once CLASS_PATH . "/Links.php";

try {
    if (!isset($_POST['id'])) {
        throw new Exception("Missing ID");
    }

    $id = intval($_POST['id']);

    $links = new Links($pdo);
    $deleted = $links->deleteLinks($id);

    if ($deleted) {
        echo json_encode([
            "status" => "success",
            "id" => $id
        ]);
    } else {
        throw new Exception("Delete failed");
    }
} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}
