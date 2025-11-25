<?php
class Projects
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function showAllProjects()
    {
        $sql = "SELECT * FROM projects ORDER BY id asc";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addProject($projectName, $description, $liveDemo, $sourceCode, $image)
    {
        $sql = "INSERT INTO projects (projectName, description, liveDemo, sourceCode, image)
            VALUES (:projectName, :description, :liveDemo, :sourceCode, :image)";
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':projectName' => $projectName,
            ':description' => $description,
            ':liveDemo' => $liveDemo,
            ':sourceCode' => $sourceCode,
            ':image' => $image
        ]);

        return $this->pdo->lastInsertId();
    }

    public function deleteProject($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM projects WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
