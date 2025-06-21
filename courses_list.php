<?php
session_start();
require('config.php');
// Fetch subjects
$query = "SELECT * FROM subjects";
$result = $conn->query($query);


// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $semester_id = $_POST['semester_id'];

        $stmt = $conn->prepare("INSERT INTO subjects (id, name, semester_id) VALUES (?, ?, ?)");
        $stmt->bind_param('sss', $id, $name, $semester_id);
        $stmt->execute();
        $stmt->close();

        $_SESSION['message'] = "Subject added successfully.";
        header("Location: courses_list.php");
        exit;
    } elseif (isset($_POST['update'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $semester_id = $_POST['semester_id'];

        $stmt = $conn->prepare("UPDATE subjects SET name = ?, semester_id = ? WHERE id = ?");
        $stmt->bind_param('sss', $name, $semester_id, $id);
        $stmt->execute();
        $stmt->close();

        $_SESSION['message'] = "Subject updated successfully.";
        header("Location: courses_list.php");
        exit;
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['id'];

        $stmt = $conn->prepare("DELETE FROM subjects WHERE id = ?");
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $stmt->close();

        $_SESSION['message'] = "Subject deleted successfully.";
        header("Location: courses_list.php");
        exit;
    }
}

// Fetch subjects
$query = "SELECT * FROM subjects";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Course List</title>
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
    <h3>Course List</h3>
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
<h2>Add New Subject</h2>
<form method="post" action="courses_list.php">
    <input type="text" name="id" placeholder="Subject ID" required>
    <input type="text" name="name" placeholder="Subject Name" required>
    <input type="text" name="semester_id" placeholder="Semester ID" required>
    <input type="submit" name="add" value="Add Subject">
</form>
<h2>Existing Subjects</h2>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Semester ID</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="subjectTable">
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id']); ?></td>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['semester_id']); ?></td>
                <td>
                    <form method="post" action="courses_list.php" class="inline-form">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                        <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required>
                        <input type="text" name="semester_id" value="<?php echo htmlspecialchars($row['semester_id']); ?>" required>
                        <input type="submit" name="update" value="Update" class="delete-button">
                    </form>
                    <form method="post" action="courses_list.php" class="inline-form">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                        <input type="submit" name="delete" value="Delete" class="delete-button" onclick="return confirm('Are you sure you want to delete this subject?');">
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
</body>
</html>
