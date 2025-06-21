<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location: index.php");
    exit;
}

// Check role and redirect accordingly
if ($_SESSION['role'] == 'student') {
    header("location: student_home.php");
} elseif ($_SESSION['role'] == 'lecturer') {
    header("location: lecturer_home.php");
} elseif ($_SESSION['role'] == 'MA') {
    header("location: MA_sidebar.php");
} else {
    echo "You do not have access to this page.";
    // Provide a link back to index or homepage
}
?>
