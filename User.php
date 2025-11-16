<?php
class User
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        session_start();
    }

    public function showInfo()
    {

        $sql = "SELECT * FROM users WHERE id = 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
