<?php
header('Content-Type: application/json');
require_once "../../path.php";
require_once CLASS_PATH . "/Education.php";
require_once BASE_PATH . "/dbConnection.php";

$edu = new Education($pdo);

try {

    // FILE UPLOAD
    $logo = $_FILES['logo'];
    $logoName = $logo['name'];

    $uploadDir = "../../schools/";
    $logoPath = $uploadDir . $logoName;

    move_uploaded_file($logo['tmp_name'], $logoPath);

    $dbLogoPath = "schools/" . $logoName;

    // FORM DATA
    $level       = $_POST['level'];
    $schoolName  = $_POST['schoolName'];
    $start_year  = $_POST['start_year'];
    $end_year    = $_POST['end_year'];
    $program     = $_POST['program'];

    $success = $edu->addEducation(
        $level,
        $schoolName,
        $dbLogoPath,
        $start_year,
        $end_year,
        $program
    );

    if ($success) {
        echo json_encode([
            "status" => "success",
            "message" => "Education Information added successfully",
            "data" => [
                "level" => $level,
                "schoolName" => $schoolName,
                "logo" => $dbLogoPath,
                "start_year" => $start_year,
                "end_year" => $end_year,
                "program" => $program
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
