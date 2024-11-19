<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM tasks WHERE id=$id");
    $task = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $task = $_POST['task'];
    $conn->query("UPDATE tasks SET task='$task' WHERE id=$id");
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <
</head>
<body>
    <div class="edit-container">
        <h2>Edit Task</h2>

        <!-- Edit task form -->
        <form method="POST" action="edit_task.php">
            <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
            <input type="text" name="task" value="<?php echo htmlspecialchars($task['task']); ?>" required>
            <button type="submit">Update Task</button>
        </form>
    </div>
</body>
</html>