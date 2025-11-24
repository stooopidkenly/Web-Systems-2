<?php
while (ob_get_level()) {
    ob_end_clean();
}

header('Content-Type: application/json');
require_once "../../path.php";
require_once CLASS_PATH . "/User.php";
require_once BASE_PATH . "/dbConnection.php";

try {
    if (
        !isset($_POST['id'], $_POST['name'], $_POST['email'], $_POST['address'], $_POST['phoneNum'], $_POST['description'])
    ) {
        throw new Exception("Missing required fields");
    }

    $id          = $_POST['id'];
    $name        = $_POST['name'];
    $email       = $_POST['email'];
    $address     = $_POST['address'];
    $phoneNum    = $_POST['phoneNum'];
    $description = $_POST['description'];

    $user = new User($pdo);
    // Get current photo
    $info = $user->showInfo();
    $currentPhoto = $info ? $info['photo'] : null;

    $newPhotoPath = $currentPhoto;

    if (
        isset($_FILES['photo']) &&
        isset($_FILES['photo']['tmp_name']) &&
        is_uploaded_file($_FILES['photo']['tmp_name'])
    ) {
        $targetDir = "../../uploads/";

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $fileName = time() . "_" . basename($_FILES['photo']['name']);
        $targetFile = $targetDir . $fileName;

        if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetFile)) {
            $newPhotoPath = "uploads/" . $fileName;
        }
    }

    // Use the User class method
    $user->update($id, $name, $email, $address, $phoneNum, $description, $newPhotoPath);

    if (function_exists('opcache_reset')) {
        opcache_reset();
    }
    echo json_encode([
        "status" => "success",
        "message" => "User Information Updated Successfully",
        "updated" => [
            "name"        => $name,
            "email"       => $email,
            "address"     => $address,
            "phoneNum"    => $phoneNum,
            "description" => $description,
            "photo"       => $newPhotoPath
        ]
    ]);
    exit;
} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
    exit;
}
