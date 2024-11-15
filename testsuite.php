<?php

include_once "enter_grades_tests.php";
include_once "process_grades_tests.php";
include_once __DIR__ . "/view_grades_test.php";

function runAllTests()
{
    echo "Running All Tests...\n\n";

    test_get_students();
    test_calculate_final_grade();

    // Check if the view_grades_tests.php file is correctly included
    if (function_exists('test_get_grades_with_data_provider')) {
        test_get_grades_with_data_provider();
    } else {
        echo "Error: test_get_grades_with_data_provider function not found.\n";
    }

    echo "\nAll Tests Completed.\n";
}

runAllTests();
