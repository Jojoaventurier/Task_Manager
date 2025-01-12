<?php
// app/model/GeneralCategory.php
class GeneralCategory
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
        $stmt = $pdo->query("SELECT * FROM general_categories");
        $categories = [];
        while ($row = $stmt->fetch()) {
            $categories[] = new self($row['id'], $row['name']);
        }
        return $categories;
    }
}