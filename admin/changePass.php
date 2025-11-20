<?php
require_once "../path.php";
require_once CLASS_PATH . "/AdminAuth.php";
require_once BASE_PATH . "/dbConnection.php";

$auth = new AdminAuth($pdo);
$auth->requireLogin();
$changed = "Password Changed Successfully";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $pass = $_POST['password'];
    $confirm = $_POST['confirm'] ?? null;

    if ($pass !== $confirm) {
        die("Error: Passwords do not match.");
    }

    if ($auth->changePassword($pass)) {
        $_SESSION['changed'] = "Password Changed Successfully";
        header("Location: adminDashboard.php");
        exit();
    } else {
        echo "Failed to update password.";
    }
}
