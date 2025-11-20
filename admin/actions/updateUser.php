<?php
require_once "../../path.php";
require_once CLASS_PATH . "/User.php";
require_once BASE_PATH . "/dbConnection.php";

$user = new User($pdo); // create an instance of the User Classfile for fetching user info.

// get the form data 
$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$address = $_POST['address'];
$phone = $_POST['phoneNum'];
$desc = $_POST['description'];

$photo = null;

// Check if file was uploaded
if (!empty($_FILES['photo']['name'])) {
    $targetDir = BASE_PATH . "/";
    $photo = $targetDir . basename($_FILES['photo']['name']);

    if (move_uploaded_file($_FILES['photo']['tmp_name'], $photo)) {
        $photo = basename($_FILES['photo']['name']);
    }
}

// Update
if ($user->update($id, $name, $email, $address, $phone, $desc, $photo)) {
    echo "User updated successfully";
} else {
    echo "Failed to update user";
}
