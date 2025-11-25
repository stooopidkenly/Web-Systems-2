<?php
header('Content-Type: application/json');
require_once "../../path.php";
require_once CLASS_PATH . "/Projects.php";
require_once BASE_PATH . "/dbConnection.php";

try {

    if (!isset($_POST['project_id'])) {
        throw new Exception("Missing project ID");
    }

    $projectId = intval($_POST['project_id']);
    $project = new Projects($pdo);

    if ($project->deleteProject($projectId)) {
        echo json_encode([
            "status" => "success",
            "message" => "Project deleted successfully"
        ]);
    } else {
        throw new Exception("Failed to delete project");
    }
} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}
