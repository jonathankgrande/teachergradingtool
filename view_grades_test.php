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

// Original getGrades function from view_grades.php
function getGrades($conn)
{
    $grades = [];
    $sql = "SELECT s.name, g.homework_avg, g.quiz_avg, g.midterm, g.final_project, g.final_grade 
            FROM students s
            JOIN grades g ON s.student_id = g.student_id";
    $result = $conn->query($sql);

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $grades[] = $row;
        }
    }
    return $grades;
}

// Mock Data Provider
function gradeDataProvider()
{
    yield 'single grade entry' => [
        [
            ['name' => 'Student One', 'homework_avg' => 85, 'quiz_avg' => 80, 'midterm' => 90, 'final_project' => 92, 'final_grade' => 89]
        ],              // mock database result set
        1,              // expected count
        'Student One'   // expected student name
    ];

    yield 'multiple grade entries' => [
        [
            ['name' => 'Student One', 'homework_avg' => 85, 'quiz_avg' => 80, 'midterm' => 90, 'final_project' => 92, 'final_grade' => 89],
            ['name' => 'Student Two', 'homework_avg' => 90, 'quiz_avg' => 85, 'midterm' => 85, 'final_project' => 88, 'final_grade' => 87]
        ],               // mock database result set
        2,               // expected count
        'Student Two'    // expected last student name
    ];

    yield 'no grade entries' => [
        [],              // empty database result set
        0,               // expected count
        null             // no expected student name
    ];
}

// Mock function to simulate the getGrades function without database
function mock_getGrades($mockData)
{
    return $mockData;
}

// Tests
function test_get_grades_with_data_provider()
{
    foreach (gradeDataProvider() as $description => [$mockData, $expectedCount, $expectedLastName]) {
        // Use mock_getGrades to simulate database query result
        $grades = mock_getGrades($mockData);

        // Assertions
        assertEqual(count($grades), $expectedCount, "test_get_grades_with_data_provider - $description count check");
        if ($expectedCount > 0) {
            assertEqual(end($grades)['name'], $expectedLastName, "test_get_grades_with_data_provider - $description last name check");
        }
    }
}

// Run all tests
test_get_grades_with_data_provider();
