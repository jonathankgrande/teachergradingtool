<?php

if (!function_exists('assertEqual')) {
    function assertEqual($actual, $expected, $message)
    {
        if (is_numeric($actual) && is_numeric($expected)) {
            $actual = round($actual, 2);
            $expected = round($expected, 2);
        }

        if ($actual == $expected) {
            echo "[PASS] $message\n";
        } else {
            echo "[FAIL] $message: Expected $expected, got $actual\n";
        }
    }
}

function calculateFinalGrade($homeworks, $quizzes, $midterm, $finalProject)
{
    // Handle empty homework array
    $homeworkAvg = !empty($homeworks) ? array_sum($homeworks) / count($homeworks) : 0;

    // Handle empty or one quiz
    if (!empty($quizzes) && count($quizzes) > 1) {
        sort($quizzes);
        array_shift($quizzes); // Drop the lowest quiz score
        $quizAvg = array_sum($quizzes) / count($quizzes);
    } elseif (!empty($quizzes)) {
        $quizAvg = $quizzes[0]; // If only one quiz exists
    } else {
        $quizAvg = 0; // No quizzes
    }

    // Calculate the final grade
    $finalGrade = ($homeworkAvg * 0.20) + ($quizAvg * 0.10) + ($midterm * 0.30) + ($finalProject * 0.40);
    return round($finalGrade);
}


// Data provider for test cases using yield
function gradeCalculationDataProvider()
{
    yield 'standard calculation' => [
        [75, 89, 103, 55, 100],    // homeworks
        [65, 78, 99, 76, 69],      // quizzes
        86,                        // midterm
        90,                        // final project
        87                         // expected result
    ];

    yield 'perfect scores' => [
        [100, 100, 100, 100, 100], // homeworks
        [100, 100, 100, 100, 100], // quizzes
        100,                       // midterm
        100,                       // final project
        100                        // expected result
    ];

    yield 'no quizzes' => [
        [75, 80, 70, 85, 90],      // homeworks
        [],                        // no quizzes
        85,                        // midterm
        95,                        // final project
        80                         // updated expected result
    ];
    

    yield 'one quiz' => [
        [70, 85, 90, 60, 80],      
        [50],                     
        70,                        
        90,                        
        77                       
    ];
}

// Test function
function test_calculate_final_grade()
{
    foreach (gradeCalculationDataProvider() as $description => [$homeworks, $quizzes, $midterm, $finalProject, $expected]) {
        $result = calculateFinalGrade($homeworks, $quizzes, $midterm, $finalProject);
        assertEqual($result, $expected, "test_calculate_final_grade - $description");
    }
}

// Run the tests
test_calculate_final_grade();
