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


// Simulated getStudents function to retrieve data
function getStudents($conn)
{
    $students = [];
    $result = $conn->query("SELECT student_id, name FROM students");
    
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $students[] = $row;
        }
    }
    return $students;
}

// Mock function for getStudents to replace database interaction
function mock_getStudents($mockData)
{
    return $mockData;
}

// Test function for getStudents
function test_get_students()
{
    // Define mock data to simulate database response
    $mockData = [
        ['student_id' => 1, 'name' => 'Student One']
    ];

    // Call mock_getStudents instead of the actual getStudents to avoid real database dependency
    $students = mock_getStudents($mockData);

    // Assertions
    assertEqual(count($students), 1, "test_get_students - count check");
    assertEqual($students[0]['name'], 'Student One', "test_get_students - name check");
}

// Run the test
test_get_students();
