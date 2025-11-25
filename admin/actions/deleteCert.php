<?php
header('Content-Type: application/json');
require_once "../../path.php";
require_once CLASS_PATH . "/Links.php";
require_once BASE_PATH . "/dbConnection.php";

try {
    if (!isset($_POST['cert_id'])) {
        throw new Exception("Missing cert ID");
    }

    $certId = intval($_POST['cert_id']);
    $links = new Links($pdo);

    if ($links->deleteCert($certId)) {
        echo json_encode([
            "status" => "success",
            "message" => "Certificate deleted successfully"
        ]);
    } else {
        throw new Exception("Failed to delete certificate");
    }
} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}
