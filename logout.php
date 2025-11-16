<?php
require "dbConnection.php";
require "AdminAuth.php";

$auth = new AdminAuth($pdo);

$auth->logout();
