<?php
$data = loadData();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Management</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f2f2f2; }
        button { margin: 5px; padding: 5px 10px; }
    </style>
</head>
<body>
    <h1>Data Management</h1>

    <!-- Display Data -->
    <table>
        <thead>
            <tr>
                <th>General Category</th>
                <th>Category</th>
                <th>Tasks</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $generalCategory => $details): ?>
                <?php foreach ($details['categories'] as $category => $categoryDetails): ?>
                    <tr>
                        <td><?= htmlspecialchars($generalCategory) ?></td>
                        <td><?= htmlspecialchars($category) ?></td>
                        <td>
                            <ul>
                                <?php foreach ($categoryDetails['tasks'] as $task): ?>
                                    <li><?= htmlspecialchars($task) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Buttons -->
    <form method="POST" action="/handle-data">
        <input type="hidden" name="action" value="reset">
        <button type="submit">Reset Data</button>
    </form>
    
    <button id="edit-data">Edit Data</button>
    <button id="save-data" style="display: none;">Save Changes</button>

    <!-- Editable JSON -->
    <textarea id="data-editor" style="width: 100%; height: 300px; display: none;"><?= json_encode($data, JSON_PRETTY_PRINT) ?></textarea>

    <script>
        const editButton = document.getElementById('edit-data');
        const saveButton = document.getElementById('save-data');
        const dataEditor = document.getElementById('data-editor');

        editButton.addEventListener('click', () => {
            dataEditor.style.display = 'block';
            saveButton.style.display = 'inline-block';
            editButton.style.display = 'none';
        });

        saveButton.addEventListener('click', async () => {
            const updatedData = dataEditor.value;

            try {
                JSON.parse(updatedData); // Validate JSON
                await fetch('/handle-data', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ action: 'update', data: updatedData })
                });
                alert('Data saved successfully!');
                location.reload();
            } catch (error) {
                alert('Invalid JSON format. Please correct it.');
            }
        });
    </script>
</body>
</html>