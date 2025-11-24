<?php
header('Content-Type: application/json');
require_once "../../path.php";
require_once CLASS_PATH . "/Education.php";
require_once BASE_PATH . "/dbConnection.php";

try {
    $education = new Education($pdo);
    $eduList = $education->showEducation(); // returns all education records as array

    echo json_encode([
        'status' => 'success',
        'data' => $eduList
    ]);
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
