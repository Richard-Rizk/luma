<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['UserId'])) {
    // User is not logged in, redirect to login page
    header("Location: /Learning-Platform/login.html");
    exit();
}

// Retrieve LessonId from URL
$lessonId = isset($_GET['lessonId']) ? $_GET['lessonId'] : null;

// Define the JavaScript code to redirect with LessonId
$redirectScript = "<script>
                    var lessonId = '$lessonId';
                    window.location.href = 'student-take-lesson.html?lessonId=' + lessonId;
                   </script>";

// Output the JavaScript code to perform the redirection
echo $redirectScript;
?>