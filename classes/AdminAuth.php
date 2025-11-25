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
        // Fetch admin by username
        $sql = "SELECT * FROM admin WHERE username = :username LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['username' => $username]);

        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        // If user exists
        if ($admin) {

            // Case 1: password is already hashed
            if (password_verify($password, $admin['password'])) {
                $_SESSION['isLoggedIn'] = true;
                return true;
            }

            // Case 2: password in database is still plain text
            if ($password === $admin['password']) {

                // Convert & update hashed password
                $newHash = password_hash($password, PASSWORD_DEFAULT);

                $update = $this->pdo->prepare(
                    "UPDATE admin SET password = :hash WHERE id = :id"
                );

                $update->execute([
                    'hash' => $newHash,
                    'id'   => $admin['id']
                ]);

                $_SESSION['isLoggedIn'] = true;
                return true;
            }

            // Wrong password
            return false;
        }

        // No admin found
        return false;
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
