<?php
// app/models/Mode.php
class Mode
{
    public int $id;
    public string $name;

    public function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public static function getAll(PDO $pdo): array
    {
        $stmt = $pdo->query("SELECT * FROM modes");
        $modes = [];
        while ($row = $stmt->fetch()) {
            $modes[] = new self($row['id'], $row['name']);
        }
        return $modes;
    }
}