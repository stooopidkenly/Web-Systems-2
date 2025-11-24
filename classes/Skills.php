<?php
class Skills
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function showAllSkills()
    {
        $sql = "SELECT * FROM skills ORDER BY id asc";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addSkills(){
        
    }
}
