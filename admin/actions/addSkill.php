<?php


header('Content-Type: application/json');
require_once "../../path.php";
require_once CLASS_PATH . "/Skills.php";
require_once BASE_PATH . "/dbConnection.php";


$skill = new Skills($pdo);

try {

    $skillName = $_POST['skillName'] ?? '';
    $skillLevel = $_POST['skillLevel'] ?? '';

    if (!empty($skillName && $skill)) {

        $success = $skill->addSkills(
            $skillName,
            $skillLevel
        );
    } else {
        echo "Error";
    }

    if ($success) {
        echo json_encode([
            "status" => "success",
            "message" => "Additional Skill Added Successfully",
            "data" => [
                "skillName" => $skillName,
                "skillLevel" => $skillLevel

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
