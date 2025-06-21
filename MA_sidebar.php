
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'MA') {
    header("location: index.php");
    exit;
}

$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MA Dashboard</title>
    
         <style>
      
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    overflow-x: hidden;
}

header {
    background-color: #656ce4;
    color: #fff;
    padding: 20px;
    text-align: center;
}

#container1 {
    display: flex;
}

#sidebar1 {
    position: fixed;
    width: 250px;
    height: 100%;
    background-color: #ffffff;
    color: #0a4282;
    border-radius: 5px;
    box-shadow: 2px 0px 5px rgba(0, 0, 0, 0.2);
    padding: 10px;
}

#sidebar1 nav ul {
    list-style-type: none;
    padding: 0;
}

#sidebar1 nav ul li {
    margin-bottom: 10px;
}

#sidebar1 nav ul li a {
    text-decoration: none;
    color: #1255a1;
    display: block;
    padding: 10px;
    border-radius: 5px;
    background-color: #f2f2f2;
}

#sidebar1 nav ul li a:hover {
    background-color: #0d3a6c;
    color: #fff;
}

#content {
    margin-left: 260px;
    padding: 20px;
    flex-grow: 1;
    width: calc(100% - 250px);
}

.notice-ribbon {
    background-color: #e0e0e0;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.notices {
    background-color: #d4edda;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}
   

    </style>
</head>
<body>
    <header>
        <h1>The Feedback Management System</h1>
        <h2>Welcome, <?php echo htmlspecialchars($email); ?>!</h2>
    </header>
    <div id="container1">
        <div id="sidebar1">
            <nav>
                <ul>
                    <li><a href="javascript:void(0);" onclick="loadContent('lecturer_list.php')">Lecturer List</a></li>
                    <li><a href="javascript:void(0);" onclick="loadContent('courses_list.php')">Courses List</a></li>
                    <li><a href="javascript:void(0);" onclick="loadContent('ma_lecturer_feedback_editor.php')">Lecturer Feedback Form</a></li>
                    <li><a href="javascript:void(0);" onclick="loadContent('ma_feedback_editor.php')">Course Feedback Form</a></li>
                    <li><a href="javascript:void(0);" onclick="loadContent('student_list.php')">Users List</a></li>
                    <li><a href="javascript:void(0);" onclick="loadContent('notice.php')">Make a Notice</a></li>
                    <li><a href="javascript:void(0);" onclick="loadContent('summary.php')">Summary</a></li>
                    <li><a href="javascript:void(0);" onclick="loadContent('courses_lecturers.php')">Courses_lecturers</a></li>
                    <li><a href="logout.php">Logout</a></li>
                    <li><a href="reset_password.php">Reset Password</a></li>
                </ul>
            </nav>
        </div>
        <div id="content">
            <!-- Initial content loaded here -->
        </div>
    </div>
    <script>
        function loadContent(page) {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', page, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById('content').innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        }

        // Load the default content (initially show content from MA_home.php)
        window.onload = function() {
            loadContent('MA_home.php');
        };
    </script>
</body>
</html>

  