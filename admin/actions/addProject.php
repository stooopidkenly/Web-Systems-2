<?php

header('Content-Type: application/json');
require_once "../../path.php";
require_once CLASS_PATH . "/Projects.php";
require_once BASE_PATH . "/dbConnection.php";

$project = new Projects($pdo);

try {
    if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        throw new Exception("Image upload failed");
    }

    $image = $_FILES['image'];
    $imageName = $image['name'];
    $uploadDir = "../../projects/";
    $imagePath = $uploadDir . $imageName;

    if (!move_uploaded_file($image['tmp_name'], $imagePath)) {
        throw new Exception("Failed to move uploaded file");
    }

    $projectImagePath = "projects/" . $imageName;

    // form data
    $projectName = $_POST['projectName'] ?? '';
    $description = $_POST['description'] ?? '';
    $liveDemo = $_POST['liveDemo'] ?? '';
    $sourceCode = $_POST['sourceCode'] ?? '';

    $projectId = $project->addProject(
        $projectName,
        $description,
        $liveDemo,
        $sourceCode,
        $projectImagePath
    );

    if ($projectId) {
        echo json_encode([
            "status" => "success",
            "message" => "Project Added Successfully",
            "data" => [
                'id' => $projectId,
                'projectName' => $projectName,
                'description' => $description,
                'liveDemo' => $liveDemo,
                'sourceCode' => $sourceCode,
                'image' => $projectImagePath
            ]
        ]);
        exit;
    }

    echo json_encode([
        "status" => "error",
        "message" => "Failed to insert data."
    ]);
} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}
