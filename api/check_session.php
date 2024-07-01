<?php
// Start session
session_start();

// Ensure errors are displayed for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if the user is logged in
if (!isset($_SESSION['UserId'])) {
    // User is not logged in, prepare JSON response
    $response = array(
        'logged_in' => false,
        'message' => 'User is not logged in'
    );
} else {
    // User is logged in, prepare JSON response
    $response = array(
        'logged_in' => true,
        'user_name' => $_SESSION['UserName']
    );
}

// Set content type header to application/json
header('Content-Type: application/json');

// Output the JSON response
echo json_encode($response);
?>
