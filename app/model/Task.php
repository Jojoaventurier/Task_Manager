<?php
// app/models/Task.php
class Task
{
    public int $id;
    public string $name;
    public int $categoryId;
    public ?int $modeId;
    public bool $isActive;

    public function __construct(int $id, string $name, int $categoryId, ?int $modeId, bool $isActive)
    {
        $this->id = $id;
        $this->name = $name;
        $this->categoryId = $categoryId;
        $this->modeId = $modeId;
        $this->isActive = $isActive;
    }

    public static function getAll(PDO $pdo): array
    {
        $stmt = $pdo->query("
            SELECT tasks.*, categories.name AS category_name, modes.name AS mode_name, general_categories.name AS general_category_name
            FROM tasks
            LEFT JOIN categories ON tasks.category_id = categories.id
            LEFT JOIN modes ON tasks.mode_id = modes.id
            LEFT JOIN general_categories ON categories.general_category_id = general_categories.id
        ");
        $tasks = [];
        while ($row = $stmt->fetch()) {
            $tasks[] = $row;
        }
        return $tasks;
    }
}
