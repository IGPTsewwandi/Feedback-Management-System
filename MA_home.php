<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'MA') {
    header("location: index.php");
    exit;
}

$email = $_SESSION['email'];

require('config.php');

$notice_query = "SELECT notice_id as nid, heading FROM notice";
$notice_result = mysqli_query($conn, $notice_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MA Dashboard</title>
</head>
<body>
    <main>
        <div class="contentbox">
            <h1 style="padding:5%;">Notices</h1>
            <div class="notices">
                <?php while ($row = mysqli_fetch_assoc($notice_result)): ?>
                    <div class="notice-item">
                        <?php echo htmlspecialchars($row['heading']); ?>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </main>
</body>
</html>
