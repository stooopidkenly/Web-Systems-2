<?php
session_start();
require_once "path.php";
require_once "dbConnection.php";
require_once CLASS_PATH . "/AdminAuth.php";

$auth = new AdminAuth($pdo);

$auth->logout();
