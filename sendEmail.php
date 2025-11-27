<?php
ob_clean();
header("Content-Type: application/json");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . "/vendor/autoload.php";

if (!empty($_POST['trap'])) {
    echo json_encode(["status" => "error", "message" => "Bot detected"]);
    exit;
}

// Validate input
$name = trim($_POST["name"] ?? "");
$email = trim($_POST["email"] ?? "");
$message = trim($_POST["message"] ?? "");

if ($name === "" || $email === "" || $message === "") {
    echo json_encode(["status" => "error", "message" => "All fields are required"]);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(["status" => "error", "message" => "Invalid email format"]);
    exit;
}

$mail = new PHPMailer(true);

try {
    // SMTP CONFIG
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = "johnkenly1120@gmail.com";
    $mail->Password = "uxonohkmynvgnmoz";
    $mail->SMTPSecure = "tls";
    $mail->Port = 587;

    // Set headers
    $mail->setFrom($email, $name);
    $mail->addAddress("johnkenly1120@gmail.com");

    // Content
    $mail->isHTML(true);
    $mail->Subject = "New Message from Portfolio Contact Form";
    $mail->Body = "
        <h3>Sender Info</h3>
        <p><strong>Name:</strong> $name</p>
        <p><strong>Email:</strong> $email</p><br>

        <h3>Message</h3>
        <p>$message</p>
    ";

    $mail->send();

    echo json_encode(["status" => "success", "message" => "Sent"]);
    exit;
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "Mail error: {$mail->ErrorInfo}"]);
    exit;
}
