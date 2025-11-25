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

    public function addSkills($skillName, $skillLevel)
    {
        $sql = "INSERT INTO skills (skillName, SkillLevel)
        VALUES (:skillName, :skillLevel)";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':skillName' => $skillName,
            ':skillLevel' => $skillLevel,
        ]);
    }

    public function updateSkill($id, $name, $level)
    {
        $stmt = $this->pdo->prepare("UPDATE skills SET skillName = ?, skillLevel = ? WHERE id = ?");
        return $stmt->execute([$name, $level, $id]);
    }

    public function deleteSkill($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM skills WHERE id = ?");
        return $stmt->execute([$id]);
    }

    
}
