<?php
class AdminAuth
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        session_start();
    }

    //admin login
    public function login($username, $password)
    {
        $sql = "SELECT * FROM admin WHERE username = :username LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['username' => $username]);

        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin && password_verify($password, $admin['password'])) {
            $_SESSION['isLoggedIn'] = true;
            return true;
        } else {
            return false;
        }
    }

    //logout
    public function logout()
    {
        session_unset();
        session_destroy();
        header("Location: index.php");
        exit();
    }

    public function requireLogin()
    {
        if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true) {
            header('Location: login.php');
            exit();
        }
    }

    //change password
    public function changePassword($newPass)
    {
        $hashed = password_hash($newPass, PASSWORD_DEFAULT);

        $sql = "UPDATE admin SET password = :password WHERE id=1";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute(['password' => $hashed]);
    }
}
