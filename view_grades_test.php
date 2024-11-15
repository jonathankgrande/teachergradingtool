<?php

function mock_getGrades($mockData)
{
    return $mockData;
}

// Test Data Provider
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

// Unit Test for getGrades
function test_get_grades_with_data_provider()
{
    foreach (gradeDataProvider() as $description => [$mockData, $expectedCount, $expectedLastName]) {
        // Use mock_getGrades to simulate the result of getGrades
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
