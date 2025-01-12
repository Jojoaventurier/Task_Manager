<?php
// app/model/Category.php
class Category
{
    public int $id;
    public string $name;
    public int $generalCategoryId;

    public function __construct(int $id, string $name, int $generalCategoryId)
    {
        $this->id = $id;
        $this->name = $name;
        $this->generalCategoryId = $generalCategoryId;
    }

    public static function getAll(PDO $pdo): array
    {
        $stmt = $pdo->query("SELECT * FROM categories");
        $categories = [];
        while ($row = $stmt->fetch()) {
            $categories[] = new self($row['id'], $row['name'], $row['general_category_id']);
        }
        return $categories;
    }
}