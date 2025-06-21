<?php
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    // Check if the email exists and is not registered
    $sql = "SELECT * FROM users WHERE email='$email' AND registered=0";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $sql = "UPDATE users SET username='$username', password='$password_hashed', registered=1 WHERE email='$email'";
        if ($conn->query($sql) === TRUE) {
            echo '<script>alert("Registration successful! You can now login.");';
            echo 'window.location.href = "index.php";</script>';
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo '<script>alert("Invalid email or already registered. Please try again.");';
        echo 'window.location.href = "registration.php";</script>';
    }
}
?>

<?php include("header.php"); ?>
<div id="container">
    <h2>Register</h2>
    <form method="post" action="registration.php">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required title="2021E001@eng.jfn.ac.lk">
        </div>
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required title="2021E001@eng.jfn.ac.lk">
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <input type="submit" value="Register">
    </form>
    <p>Already registered? <a href="index.php">Login here</a></p>
</div>
<?php include("footer.php"); ?>


<head>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        #container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 ,h1,h3{
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-group input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        .form-group input[type="submit"]:hover {
            background-color: #45a049;
        }

        p {
            text-align: center;
            margin-top: 20px;
        }

        p a {
            color: #4CAF50;
            text-decoration: none;
        }

        p a:hover {
            text-decoration: underline;
        }

        .alert {
            background-color: #f2dede;
            color: #a94442;
            border: 1px solid #ebccd1;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            text-align: center;
        }
    </style>
    </head>