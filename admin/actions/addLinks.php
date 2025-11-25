<?php
header('Content-Type: application/json');
require_once "../../path.php";
require_once BASE_PATH . "/dbConnection.php";
require_once CLASS_PATH . "/Links.php";

try {
    if (!isset($_POST['platform']) || !isset($_POST['link'])) {
        throw new Exception("Missing fields");
    }

    $platform = trim($_POST['platform']);
    $link = trim($_POST['link']);

    $links = new Links($pdo);
    $lastId = $links->addLinks($platform, $link);

    echo json_encode([
        "status" => "success",
        "data" => [
            "id" => $lastId,
            "platform" => $platform,
            "link" => $link
        ]
    ]);
} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}
