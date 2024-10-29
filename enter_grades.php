<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Enter Student Grades</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Teacher Grading Tool</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="enter_grades.php">Enter Grades</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_grades.php">View Grades</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="text-center mt-5">Welcome to the Teacher Grading Tool</h2>
        <p class="text-center mt-5">Use the navigation bar to manage student grades, enter new grades, or view final results. <br> Please ensure all grades are filled in. If a student did not submit an assignment, enter a zero (0) for that field. <br> Incomplete grades will prevent form submission.  <br> You may also navigate to the final grades page after you submit the grades, you will be presented with options.</p>
        <div class="form-container bg-white p-4 rounded shadow-sm">
            <form action="process_grades.php" method="post">
                <?php
                // Connect to database
                $conn = new mysqli('localhost', 'csc350', 'xampp', 'teachergradingtool');
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Fetch students from the database
                $result = $conn->query("SELECT student_id, name FROM students");
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='student-entry mb-4 border-bottom pb-3'>";
                    echo "<h5>" . htmlspecialchars($row['name']) . "</h5>";
                    echo "<input type='hidden' name='student_id[]' value='" . $row['student_id'] . "'>";

                    // Define fields to collect grades
                    $fields = ["homework_1", "homework_2", "homework_3", "homework_4", "homework_5", 
                               "quiz_1", "quiz_2", "quiz_3", "quiz_4", "quiz_5", 
                               "midterm", "final_project"];
                    
                    //The grades for each student are entered in a single submission, ensuring that all scores are provided at once before storing them in the database.
                    foreach ($fields as $field) {
                        echo "<div class='mb-2'>
                                <label for='{$field}_{$row['student_id']}' class='form-label'>".ucwords(str_replace('_', ' ', $field)).":</label>
                                <input type='number' name='{$field}[]' id='{$field}_{$row['student_id']}' class='form-control' required>                           
                                </div>";
                    } 
                    echo "</div>";
                }
                $conn->close();
                ?>

                <button type="submit" class="btn btn-primary w-100">Submit Grades for All Students</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>