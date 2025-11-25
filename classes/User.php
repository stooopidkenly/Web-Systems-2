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
        $sql = "SELECT * FROM users LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function update($id, $name, $email, $address, $phoneNum, $description, $photo)
    {
        $sql = "UPDATE users SET 
            name = ?, 
            email = ?, 
            address = ?, 
            phoneNum = ?, 
            description = ?, 
            photo = ? 
            WHERE id = ?";

        $params = [$name, $email, $address, $phoneNum, $description, $photo, $id];

        $stmt = $this->pdo->prepare($sql);
        $result = $stmt->execute($params);

        return $result;
    }


    public function addTitle($title)
    {
        $stmt = $this->pdo->prepare("INSERT INTO titles(title) VALUES(:title)");
        $stmt->execute([':title' => $title]);
        return $this->pdo->lastInsertId();
    }

    public function deleteTitle($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM titles WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
