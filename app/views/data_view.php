<?php
require_once 'database.php';
$data = getAllData();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Management</title>
</head>
<body>
    <h1>Data Management</h1>
    
    <!-- General Categories, Categories, and Tasks -->
    <table>
        <thead>
            <tr>
                <th>General Category</th>
                <th>Category</th>
                <th>Task</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $currentGeneralCategory = null;
            foreach ($data as $row) {
                if ($row['general_category_name'] !== $currentGeneralCategory) {
                    $currentGeneralCategory = $row['general_category_name'];
                    echo "<tr><td colspan='4'><strong>{$row['general_category_name']}</strong></td></tr>";
                }
                echo "<tr>
                        <td></td>
                        <td>{$row['category_name']}</td>
                        <td>{$row['task_name']}</td>
                        <td>
                            <form method='POST' action='/edit-task'>
                                <input type='hidden' name='task_id' value='{$row['task_id']}'>
                                <input type='text' name='new_task_name' value='{$row['task_name']}'>
                                <button type='submit'>Edit</button>
                            </form>
                            <form method='POST' action='/delete-task'>
                                <input type='hidden' name='task_id' value='{$row['task_id']}'>
                                <button type='submit'>Delete</button>
                            </form>
                        </td>
                    </tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Add Task Form -->
    <h3>Add Task</h3>
    <form method="POST" action="/add-task">
        <label for="category">Category:</label>
        <select name="category_id" required>
            <?php
            $stmt = $pdo->query('SELECT * FROM categories');
            while ($category = $stmt->fetch()) {
                echo "<option value='{$category['id']}'>{$category['name']}</option>";
            }
            ?>
        </select><br>
        <label for="task_name">Task:</label>
        <input type="text" name="task_name" required><br>
        <button type="submit">Add Task</button>
    </form>
</body>
</html>