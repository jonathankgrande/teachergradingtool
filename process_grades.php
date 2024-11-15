<?php
// Establish a database connection
$conn = new mysqli('localhost', 'csc350', 'xampp', 'teachergradingtool');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Loop through the array of student IDs
$student_ids = $_POST['student_id'];
$homework_1 = $_POST['homework_1'];
$homework_2 = $_POST['homework_2'];
$homework_3 = $_POST['homework_3'];
$homework_4 = $_POST['homework_4'];
$homework_5 = $_POST['homework_5'];
$quiz_1 = $_POST['quiz_1'];
$quiz_2 = $_POST['quiz_2'];
$quiz_3 = $_POST['quiz_3'];
$quiz_4 = $_POST['quiz_4'];
$quiz_5 = $_POST['quiz_5'];
$midterm = $_POST['midterm'];
$final_project = $_POST['final_project'];

for ($i = 0; $i < count($student_ids); $i++) {
    // Calculate homework average
    $homework_avg = ($homework_1[$i] + $homework_2[$i] + $homework_3[$i] + $homework_4[$i] + $homework_5[$i]) / 5;

    $quiz_scores = [$quiz_1[$i], $quiz_2[$i], $quiz_3[$i], $quiz_4[$i], $quiz_5[$i]];
    sort($quiz_scores); // Sort the scores in ascending order
    array_shift($quiz_scores); // Removes the lowest score

    // Calculate average of the remaining quiz scores
    $quiz_avg = array_sum($quiz_scores) / count($quiz_scores);

    $final_grade = ($homework_avg * 0.20) + ($quiz_avg * 0.10) + ($midterm[$i] * 0.30) + ($final_project[$i] * 0.40);
    $final_grade = round($final_grade);

    // Insert grades into the 'grades' table
    $sql = "INSERT INTO grades (student_id, homework_1, homework_2, homework_3, homework_4, homework_5,
                                quiz_1, quiz_2, quiz_3, quiz_4, quiz_5, midterm, final_project, 
                                homework_avg, quiz_avg, final_grade)
            VALUES ('{$student_ids[$i]}', '{$homework_1[$i]}', '{$homework_2[$i]}', '{$homework_3[$i]}', '{$homework_4[$i]}', '{$homework_5[$i]}', 
                    '{$quiz_1[$i]}', '{$quiz_2[$i]}', '{$quiz_3[$i]}', '{$quiz_4[$i]}', '{$quiz_5[$i]}', '{$midterm[$i]}', '{$final_project[$i]}', 
                    '$homework_avg', '$quiz_avg', '$final_grade')";

    if (!$conn->query($sql)) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Grades Submission Result</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="alert alert-success text-center">
            Grades have been inserted successfully for all students.
        </div>
        <div class="text-center mt-4">
            <a href="enter_grades.php" class="btn btn-primary">Home Page</a>
            <a href="view_grades.php" class="btn btn-secondary">View Grades</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
