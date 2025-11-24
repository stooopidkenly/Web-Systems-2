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
}
