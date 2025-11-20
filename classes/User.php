<?php
class User
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function showInfo()
    {

        $sql = "SELECT * FROM users WHERE id = 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $name, $email, $address, $phoneNum, $description, $photo = null)
    {
        if ($photo) {
            $sql = "UPDATE users SET name=?, email=?, address=?, phoneNum=?, description=?, photo=? WHERE id=?";
            $params = [$name, $email, $address, $phoneNum, $description, $photo, $id];
        } else {
            $sql = "UPDATE users SET name=?, email=?, address=?, phoneNum=?, description=? WHERE id=?";
            $params = [$name, $email, $address, $phoneNum, $description, $id];
        }

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }
}
