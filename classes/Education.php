<?php
class Education
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function showEducation()
    {
        $sql = "SELECT * FROM education ORDER BY id asc";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addEducation($level, $schoolName, $logoPath, $start_year, $end_year, $program)
    {
        $sql = "INSERT INTO education (level, schoolName, logo, start_year, end_year, program)
            VALUES (:level, :schoolName, :logo, :start_year, :end_year, :program)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':level' => $level,
            ':schoolName' => $schoolName,
            ':logo' => $logoPath,
            ':start_year' => $start_year,
            ':end_year' => $end_year,
            ':program' => $program
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM education WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
