<?php
session_start();
require('config.php');

// Fetch existing subject-lecturer assignments
$query = "SELECT * FROM subject_lecturers";
$result = $conn->query($query);

// Fetch subjects and lecturers for dropdowns
$subjectsQuery = "SELECT id FROM subjects";
$subjectsResult = $conn->query($subjectsQuery);

$lecturersQuery = "SELECT id FROM lecturers";
$lecturersResult = $conn->query($lecturersQuery);

// Handling form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {
        $subject_id = $_POST['subject_id'];
        $lecturer_id = $_POST['lecturer_id'];

        $stmt = $conn->prepare("INSERT INTO subject_lecturers (subject_id, lecturer_id) VALUES (?, ?)");
        $stmt->bind_param('ss', $subject_id, $lecturer_id);
        $stmt->execute();
        $stmt->close();

        $_SESSION['message'] = "Subject-Lecturer assignment added successfully.";
        header("Location: courses_lecturers.php");
        exit;
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['id'];

        $stmt = $conn->prepare("DELETE FROM subject_lecturers WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->close();

        $_SESSION['message'] = "Subject-Lecturer assignment deleted successfully.";
        header("Location: courses_lecturers.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Course-Lecturer Assignments</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        h1, h2 {
            color: #333;
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
            background-color: #d9b38c; /* Light brown */
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .inline-form {
            display: inline;
        }

        .alert {
            color: red;
        }

        /* Home button styling */
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

        /* Delete button styling */
        .delete-button {
            background-color: #f44336; /* Red */
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .delete-button:hover {
            background-color: #e53935;
        }

        /* Add Assignment button styling */
        input[type="submit"][name="add"] {
            background-color: #008CBA; /* Replace with the color used in lecturer_list.php */
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"][name="add"]:hover {
            background-color: #007BB5; /* Replace with the hover color used in lecturer_list.php */
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<header>
    <h3>Course-Lecturer Assignments</h3>
</header><br><br>
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
<br><br>
<h2>Add New Assignment</h2>
<form method="post" action="courses_lecturers.php" class="inline-form" autocomplete="on">
    <select name="subject_id" required>
        <option value="">Select Subject</option>
        <?php while ($row = $subjectsResult->fetch_assoc()): ?>
            <option value="<?php echo htmlspecialchars($row['id']); ?>"><?php echo htmlspecialchars($row['id']); ?></option>
        <?php endwhile; ?>
    </select>
    <select name="lecturer_id" required>
        <option value="">Select Lecturer</option>
        <?php while ($row = $lecturersResult->fetch_assoc()): ?>
            <option value="<?php echo htmlspecialchars($row['id']); ?>"><?php echo htmlspecialchars($row['id']); ?></option>
        <?php endwhile; ?>
    </select>
    <input type="submit" name="add" value="Add Assignment">
</form>
<br><br><br><br>
<h2>Existing Assignments</h2>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Subject ID</th>
            <th>Lecturer ID</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="assignmentTable">
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id']); ?></td>
                <td><?php echo htmlspecialchars($row['subject_id']); ?></td>
                <td><?php echo htmlspecialchars($row['lecturer_id']); ?></td>
                <td>
                    <form method="post" action="courses_lecturers.php" class="inline-form">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                        <input type="submit" name="delete" value="Delete" class="delete-button" onclick="return confirm('Are you sure you want to delete this assignment?');">
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
</body>
</html>
