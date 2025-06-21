<?php
session_start();
require('config.php');

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {
        $category = $_POST['category'];
        $question = $_POST['question'];

        $stmt = $conn->prepare("INSERT INTO feedback_questions (category, question) VALUES (?, ?)");
        $stmt->bind_param('ss', $category, $question);
        $stmt->execute();
        $stmt->close();

        $_SESSION['message'] = "Question added successfully.";
        header("Location: ma_feedback_editor.php");
        exit;
    } elseif (isset($_POST['update'])) {
        $id = $_POST['id'];
        $category = $_POST['category'];
        $question = $_POST['question'];

        $stmt = $conn->prepare("UPDATE feedback_questions SET category = ?, question = ? WHERE id = ?");
        $stmt->bind_param('sss', $category, $question, $id);
        $stmt->execute();
        $stmt->close();

        $_SESSION['message'] = "Question updated successfully.";
        header("Location: ma_feedback_editor.php");
        exit;
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['id'];

        $stmt = $conn->prepare("DELETE FROM feedback_questions WHERE id = ?");
        $stmt->bind_param('s', $id);
        
        try {
            $stmt->execute();
            $stmt->close();

            $_SESSION['message'] = "Question deleted successfully.";
        } catch (mysqli_sql_exception $e) {
            error_log("Error deleting question: " . $e->getMessage());
            $_SESSION['message'] = "Failed to delete question. It may be referenced in other records.";
        }
        
        header("Location: ma_feedback_editor.php");
        exit;
    }
}


// Fetch feedback questions
$query = "SELECT * FROM feedback_questions";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Feedback Form Editor</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #4CAF50;
            color: white;
            padding: 10px 0;
            text-align: center;
            margin-bottom: 20px;
        }

        .message {
            background-color: #dff0d8;
            color: #3c763d;
            border: 1px solid #d6e9c6;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
        }

        form {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #d9b38c;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        button, input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover, input[type="submit"]:hover {
            background-color: #45a049;
        }

        .delete-button {
            background-color: #f44336;
            color: white;
        }

        .delete-button:hover {
            background-color: #e53935;
        }

        .home-button {
            display: inline-flex;
            align-items: center;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            margin-bottom: 20px;
        }

        .home-button:hover {
            background-color: #45a049;
        }

        .home-button .icon {
            margin-right: 10px;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<header>
    <h3>Feedback Form Editor</h3>
</header>
<a href="MA_sidebar.php" class="home-button">
    <i class="fas fa-home icon"></i>
    Home
</a>
<?php
if (isset($_SESSION['message'])) {
    echo '<div class="message">' . $_SESSION['message'] . '</div>';
    unset($_SESSION['message']);
}
?>
<h2>Add New Question</h2>
<form method="post" action="ma_feedback_editor.php">
    <input type="text" name="category" placeholder="Category" required>
    <input type="text" name="question" placeholder="Question" required>
    <input type="submit" name="add" value="Add Question">
</form>
<h2>Existing Questions</h2>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Category</th>
            <th>Question</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="questionTable">
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id']); ?></td>
                <td><?php echo htmlspecialchars($row['category']); ?></td>
                <td><?php echo htmlspecialchars($row['question']); ?></td>
                <td>
                    <form method="post" action="ma_feedback_editor.php" class="inline-form">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                        <input type="text" name="category" value="<?php echo htmlspecialchars($row['category']); ?>" required>
                        <input type="text" name="question" value="<?php echo htmlspecialchars($row['question']); ?>" required>
                        <input type="submit" name="update" value="Update" class="delete-button">
                    </form>
                    <form method="post" action="ma_feedback_editor.php" class="inline-form">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                        <input type="submit" name="delete" value="Delete" class="delete-button" onclick="return confirm('Are you sure you want to delete this question?');">
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
</body>
</html>