<?php
header('Content-Type: application/json');
require_once "../../path.php";
require_once CLASS_PATH . "/Links.php";
require_once BASE_PATH . "/dbConnection.php";

$links = new Links($pdo);

try {
    if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        throw new Exception("Image upload failed");
    }

    $image = $_FILES['image'];
    $imageName = time() . "_" . $image['name']; 
    $uploadDir = "../../certs/";
    $imagePath = $uploadDir . $imageName;

    if (!move_uploaded_file($image['tmp_name'], $imagePath)) {
        throw new Exception("Failed to move uploaded file");
    }

    $certFilePath = "certs/" . $imageName;

    $name = $_POST['projectName'] ?? '';

    // Insert to database
    $linksID = $links->addCert($name, $certFilePath);

    if ($linksID) {
        echo json_encode([
            "status" => "success",
            "message" => "Certificate Added Successfully",
            "data" => [
                'id' => $linksID,
                'certs' => $certFilePath,
                'name' => $name
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
