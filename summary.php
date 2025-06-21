<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'MA') {
    header("location: index.php");
    exit;
}

require('config.php');

// Fetch subjects for selection
$subject_query = "SELECT DISTINCT course_unit FROM course_evaluation";
$subject_result = mysqli_query($conn, $subject_query);

// Handle form submission
$selected_subject = $_POST['subject'] ?? '';
$summary_type = $_POST['summary_type'] ?? '';
$selected_lecturer = $_POST['lecturer'] ?? '';

$course_summary = '';
$lecturer_summary = '';
$chart_data = [];

// Function to get question text based on question ID
function get_question_text($conn, $question_id, $table) {
    $query = "SELECT question FROM $table WHERE id = '$question_id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['question'] ?? 'Unknown Question';
}

if ($selected_subject && $summary_type) {
    if ($summary_type === 'course') {
        // Calculate average for course feedback
        $course_summary_query = "
            SELECT question_id, AVG(response) AS average_response, COUNT(DISTINCT email) AS student_count
            FROM course_evaluation
            WHERE course_unit = '$selected_subject'
            GROUP BY question_id
        ";
        $course_summary_result = mysqli_query($conn, $course_summary_query);
        $course_summary .= '<h2>Course Feedback Summary for ' . htmlspecialchars($selected_subject) . '</h2>';
        $course_summary .= '<table border="1"><tr><th>Question Text</th><th>Average Response</th><th>Student Count</th></tr>';
        while ($row = mysqli_fetch_assoc($course_summary_result)) {
            $question_text = get_question_text($conn, $row['question_id'], 'feedback_questions');
            $average_response = number_format($row['average_response'], 2);
            $student_count = htmlspecialchars($row['student_count']);
            $course_summary .= "<tr><td>$question_text</td><td>$average_response</td><td>$student_count</td></tr>";

            $chart_data[] = [
                'question' => $question_text,
                'average_response' => $average_response
            ];
        }
        $course_summary .= '</table>';

    } elseif ($summary_type === 'lecturer') {
        // Fetch lecturers for the selected subject
        $lecturer_query = "
            SELECT DISTINCT lecturer_name
            FROM lecturer_evaluation
            WHERE course_unit = '$selected_subject'
        ";
        $lecturer_result = mysqli_query($conn, $lecturer_query);

        // Display form to select lecturer
        $lecturer_summary .= '<h2>Select a Lecturer for Summary</h2>';
        $lecturer_summary .= '<form method="post" action="summary.php">';
        $lecturer_summary .= '<input type="hidden" name="subject" value="' . htmlspecialchars($selected_subject) . '">';
        $lecturer_summary .= '<input type="hidden" name="summary_type" value="lecturer">';
        $lecturer_summary .= '<select name="lecturer" required>';
        $lecturer_summary .= '<option value="">Select Lecturer</option>';
        while ($row = mysqli_fetch_assoc($lecturer_result)) {
            $lecturer_summary .= '<option value="' . htmlspecialchars($row['lecturer_name']) . '">' . htmlspecialchars($row['lecturer_name']) . '</option>';
        }
        $lecturer_summary .= '</select>';
        $lecturer_summary .= '<input type="submit" value="Get Lecturer Summary">';
        $lecturer_summary .= '</form>';

        // Calculate average for lecturer feedback if lecturer is selected
        if ($selected_lecturer && $summary_type === 'lecturer') {
            $selected_lecturer = mysqli_real_escape_string($conn, $selected_lecturer);
            $lecturer_summary_query = "
                SELECT question_id, AVG(response) AS average_response, COUNT(DISTINCT email) AS student_count
                FROM lecturer_evaluation
                WHERE course_unit = '$selected_subject' AND lecturer_name = '$selected_lecturer'
                GROUP BY question_id
            ";
            $lecturer_summary_result = mysqli_query($conn, $lecturer_summary_query);
            $lecturer_summary .= '<h2>Lecturer Feedback Summary for ' . htmlspecialchars($selected_lecturer) . '</h2>';
            $lecturer_summary .= '<table border="1"><tr><th>Question Text</th><th>Average Response</th><th>Student Count</th></tr>';
            while ($row = mysqli_fetch_assoc($lecturer_summary_result)) {
                $question_text = get_question_text($conn, $row['question_id'], 'lecturer_feedback_questions');
                $average_response = number_format($row['average_response'], 2);
                $student_count = htmlspecialchars($row['student_count']);
                $lecturer_summary .= "<tr><td>$question_text</td><td>$average_response</td><td>$student_count</td></tr>";

                $chart_data[] = [
                    'question' => $question_text,
                    'average_response' => $average_response
                ];
            }
            $lecturer_summary .= '</table>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Summary</title>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<header>
    <h3>Summary Report</h3>
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

<p>The following list shows only subjects with feedback</p><br><br>
<form method="post" action="summary.php">
    <label for="subject">Select Subject:</label>
    <select name="subject" id="subject" required>
        <option value="">Select Subject</option>
        <?php
        while ($row = mysqli_fetch_assoc($subject_result)) {
            echo '<option value="' . htmlspecialchars($row['course_unit']) . '">' . htmlspecialchars($row['course_unit']) . '</option>';
        }
        ?>
    </select>

    <label for="summary_type">Select Summary Type:</label>
    <select name="summary_type" id="summary_type" required>
        <option value="">Select Type</option>
        <option value="course">Course Feedback</option>
        <option value="lecturer">Lecturer Feedback</option>
    </select>

    <input type="submit" value="Get Summary">
</form>

<?php
if ($course_summary) {
    echo $course_summary;
}

if ($lecturer_summary) {
    echo $lecturer_summary;
}
?>

<canvas id="feedbackChart" width="400" height="200"></canvas>

<script>
    const chartData = <?php echo json_encode($chart_data); ?>;

    const labels = chartData.map(data => data.question);
    const data = chartData.map(data => parseFloat(data.average_response));

    const ctx = document.getElementById('feedbackChart').getContext('2d');
    const feedbackChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Average Feedback',
                data: data,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    min: -3,
                    max: 2,
                    ticks: {
                        stepSize: 1,
                        callback: function(value) {
                            switch (value) {
                                case -3:
                                    return 'Strongly Disagree';
                                case -2:
                                    return 'Disagree';
                                case -1:
                                    return 'Somewhat Disagree';
                                case 0:
                                    return 'Not Sure';
                                case 1:
                                    return 'Agree';
                                case 2:
                                    return 'Strongly Agree';
                            }
                        }
                    }
                }
            }
        }
    });
</script>

<?php
mysqli_close($conn);
?>
</body>
</html>
