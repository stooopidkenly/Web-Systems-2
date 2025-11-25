<?php
header('Content-Type: application/json');
require_once "../../path.php";
require_once CLASS_PATH . "/Skills.php";
require_once BASE_PATH . "/dbConnection.php";

$skill = new Skills($pdo);

$deleteSkillID = $_POST['id'] ?? null;

if (empty($deleteSkillID)) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Missing skill ID'
    ]);
    exit;
}

$deleteSkillID = (int)$deleteSkillID;

$success = $skill->deleteSkill($deleteSkillID);

if ($success) {
    echo json_encode([
        'status' => 'success',
        'message' => 'Skill deleted successfully',
        'data' => [
            'id' => $deleteSkillID
        ]
    ]);
    exit;
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to delete skill'
    ]);
    exit;
}
