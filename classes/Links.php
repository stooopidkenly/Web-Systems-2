<?php
class Links
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function showAllLinks()
    {
        $sql = "SELECT * FROM links ORDER BY id asc";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addLinks($platform, $link)
    {
        $sql = "INSERT INTO links(platform, link) VALUES(:platform, :link)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':platform' => $platform,
            ':link' => $link
        ]);

        return $this->pdo->lastInsertId();
    }

    public function deleteLinks($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM links WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    public function showCert()
    {
        $sql = "SELECT * FROM certs ORDER BY id asc";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addCert($name, $filePath)
    {
        $stmt = $this->pdo->prepare("
        INSERT INTO certs (name, certs)
        VALUES (:name, :certs)
    ");

        $stmt->execute([
            ':name' => $name,
            ':certs' => $filePath
        ]);

        return $this->pdo->lastInsertId();
    }

    public function deleteCert($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM certs WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
