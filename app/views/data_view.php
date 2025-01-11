<?php
// require_once './db_connection.php';
// $data = getAllData();
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
    <table border="1">
        <thead>
            <tr>
                <th>General Category</th>
                <th>Category</th>
                <th>Task</th>
                <th>Mode</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $currentGeneralCategory = null;
            foreach ($data as $row) {
                // Display General Category header once
                if ($row['general_category_name'] !== $currentGeneralCategory) {
                    $currentGeneralCategory = $row['general_category_name'];
                    echo "<tr><td colspan='6'><strong>{$row['general_category_name']}</strong></td></tr>";
                }

                // Display each task with mode and active status
                $isActiveText = $row['is_active'] ? 'Yes' : 'No';
                $modeName = $row['mode_name'] ?? 'No Mode'; // Handle NULL mode gracefully

                echo "<tr>
                        <td></td>
                        <td>{$row['category_name']}</td>
                        <td>{$row['task_name']}</td>
                        <td>{$modeName}</td>
                        <td>{$isActiveText}</td>
                        <td>
                            <!-- Edit Task Form -->
                            <form method='POST' action='/edit-task' style='display: inline-block;'>
                                <input type='hidden' name='task_id' value='{$row['task_id']}'>
                                <input type='text' name='new_task_name' value='{$row['task_name']}' placeholder='Edit task name'>
                                <button type='submit'>Edit</button>
                            </form>
                            
                            <!-- Toggle Active/Deactivate Task -->
                            <form method='POST' action='/toggle-task' style='display: inline-block;'>
                                <input type='hidden' name='task_id' value='{$row['task_id']}'>
                                <button type='submit'>".($row['is_active'] ? 'Deactivate' : 'Activate')."</button>
                            </form>

                            <!-- Delete Task Form -->
                            <form method='POST' action='/delete-task' style='display: inline-block;'>
                                <input type='hidden' name='task_id' value='{$row['task_id']}'>
                                <button type='submit'>Delete</button>
                            </form>
                        </td>
                    </tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Add New Task Form -->
    <h3>Add New Task</h3>
    <form method="POST" action="/add-task">
        <label for="category">Category:</label>
        <select name="category_id" required>
            <?php
            // Fetch all categories to populate the dropdown
            $stmt = $pdo->query('SELECT * FROM categories');
            while ($category = $stmt->fetch()) {
                echo "<option value='{$category['id']}'>{$category['name']}</option>";
            }
            ?>
        </select><br>
        
        <label for="task_name">Task Name:</label>
        <input type="text" name="task_name" required><br>

        <label for="mode">Mode:</label>
        <select name="mode_id">
            <option value="">No Mode</option>
            <?php
            // Fetch all modes to populate the dropdown
            $stmt = $pdo->query('SELECT * FROM modes');
            while ($mode = $stmt->fetch()) {
                echo "<option value='{$mode['id']}'>{$mode['name']}</option>";
            }
            ?>
        </select><br>
        
        <label for="is_active">Active:</label>
        <input type="checkbox" name="is_active" value="1" checked><br>
        
        <button type="submit">Add Task</button>
    </form>

    <!-- Reset to Initial State Button -->
    <form method="POST" action="/reset-data">
        <button type="submit">Reset to Initial State</button>
    </form>
</body>
</html>