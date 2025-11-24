<?php
header('Content-Type: application/json');
require_once "../../path.php";
require_once CLASS_PATH . "/Skills.php";
require_once BASE_PATH . "/dbConnection.php";

$skill = new Skills($pdo);

$updateSkillID = $_POST['id'] ?? null;
$updateSkillName = $_POST['skillName'] ?? '';
$updateSkillLevel = $_POST['skillLevel'] ?? '';

if (empty($updateSkillID) || $updateSkillName === '' || $updateSkillLevel === '') {
    echo json_encode([
        'status' => 'error',
        'message' => 'Missing required fields'
    ]);
    exit;
}

$updateSkillID = (int)$updateSkillID;
$updateSkillLevel = (int)$updateSkillLevel;

$success = $skill->updateSkill($updateSkillID, $updateSkillName, $updateSkillLevel);

if ($success) {
    echo json_encode([
        'status' => 'success',
        'message' => 'Skill updated successfully',
        'data' => [
            'id' => $updateSkillID,
            'skillName' => $updateSkillName,
            'skillLevel' => $updateSkillLevel
        ]
    ]);
    exit;
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to update skill'
    ]);
    exit;
}
