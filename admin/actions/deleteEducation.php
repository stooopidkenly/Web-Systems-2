<?php
header('Content-Type: application/json');
require_once "../../path.php";
require_once CLASS_PATH . "/Education.php";
require_once BASE_PATH . "/dbConnection.php";

try {
    if (!isset($_POST['edu_id'])) {
        throw new Exception("Missing education ID");
    }

    $eduId = $_POST['edu_id'];
    $education = new Education($pdo);

    if ($education->delete($eduId)) {
        echo json_encode([
            "status" => "success",
            "message" => "Education deleted successfully"
        ]);
    } else {
        throw new Exception("Failed to delete education");
    }
} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}
