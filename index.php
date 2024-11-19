<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    
</head>
<body>
    <div class="todo-container">
        <h1>To-Do List</h1>

        <!-- Form to add a new task -->
        <form class="input-section" action="add_task.php" method="POST">
            <input type="text" name="task" placeholder="Enter new task" required>
            <button type="submit">Add Task</button>
        </form>

        <?php include 'db.php'; ?>

        <!-- Task table -->
        <table>
            <tr>
                <th>Task</th>
                <th>Actions</th>
            </tr>
            <?php
            // Fetch and display tasks from the database
            $result = $conn->query("SELECT * FROM tasks ORDER BY id DESC");
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['task']) . "</td>";
                echo "<td class='action-links'>
                        <a href='edit_task.php?id=" . $row['id'] . "' class='edit-btn'>Edit</a>
                        <a href='#' class='delete-btn' onclick='openModal(" . $row['id'] . ")'>Delete</a>
                      </td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <h2>Confirm Deletion</h2>
            <p>Are you sure you want to delete this task?</p>
            <div class="modal-buttons">
                <button class="confirm-btn" onclick="confirmDelete()">Delete</button>
                <button class="cancel-btn" onclick="closeModal()">Cancel</button>
            </div>
        </div>
    </div>

    <script>
        let deleteTaskId = null;

        function openModal(taskId) {
            deleteTaskId = taskId;
            document.getElementById('deleteModal').style.display = 'flex';
        }

        function closeModal() {
            deleteTaskId = null;
            document.getElementById('deleteModal').style.display = 'none';
        }

        function confirmDelete() {
            if (deleteTaskId) {
                window.location.href = `delete_task.php?id=${deleteTaskId}`;
            }
        }
    </script>
</body>
</html>