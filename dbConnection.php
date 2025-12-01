<?php

$host = "localhost";
$dbname = "portfolio";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

//practice deployment
// password = PracticePortfolio_123
// f32-preview.awardspace.net
// 4710914

//actual deployment
// password = Portfolio_Pamor3E

//host = fdb1032.awardspace.net

//name = 4671494_portfolio
// user = 	4671494_portfolio


// ftp password = UYUHm#dD3nX*wqqq