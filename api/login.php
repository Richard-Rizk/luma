<?php
session_start();

// Include the database connection file
include 'connection.php';

// Function to sanitize input and prevent SQL injection
function sanitize($input) {
    // Implement your sanitization logic here if needed
    return htmlspecialchars(strip_tags(trim($input)));
}

// Check if the request method is POST and content type is JSON
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SERVER["CONTENT_TYPE"]) && $_SERVER["CONTENT_TYPE"] === "application/json") {
    // Read the JSON input
    $input = file_get_contents('php://input');
    $data = json_decode($input, true); // Decode JSON data into associative array

    // Check if data was successfully decoded
    if (json_last_error() !== JSON_ERROR_NONE) {
        // Handle JSON decoding error
        echo json_encode([
            'success' => false,
            'message' => 'Invalid JSON data received.'
        ]);
        exit();
    }

    // Get username and password from JSON data
    $UserName = isset($data['UserName']) ? sanitize($data['UserName']) : null;
    $Password = isset($data['Password']) ? $data['Password'] : null;

    // Check if username and password are provided
    if ($UserName && $Password) {
        // Prepare SQL statement with parameterized query
        $sql = "SELECT UserId, UserName FROM tbluser WHERE UserName = ? AND Password = ?";
        $params = array($UserName, $Password); // Note: Password should be hashed in production, this is for demonstration

        // Execute the query
        $stmt = sqlsrv_query($conn, $sql, $params);

        if ($stmt === false) {
            // Log SQL error
            error_log("SQL Error: " . print_r(sqlsrv_errors(), true));
            echo json_encode([
                'success' => false,
                'message' => 'Database query error.'
            ]);
            exit();
        }

        // Fetch the user data
        $user = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

        // Check if user exists
        if ($user) {
            // User found, store in session if needed (example)
            $_SESSION['UserId'] = $user['UserId'];
            $_SESSION['UserName'] = $user['UserName'];

            // Return user details and redirect URL as JSON response
            echo json_encode([
                'success' => true,
                'redirectUrl' => 'student-take-lesson.html?lessonId=1', // Redirect URL after successful login
                'message' => 'Login successful.',
                'UserName' => $user['UserName'] // Include the UserName in the response

            ]);
            exit();
        } else {
            // Invalid username or password
            echo json_encode([
                'success' => false,
                'message' => 'Invalid UserName or Password.'
            ]);
            exit();
        }
    } else {
        // Missing username or password
        echo json_encode([
            'success' => false,
            'message' => 'Please provide both username and password.'
        ]);
        exit();
    }
} else {
    // Invalid request method or content type
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request.'
    ]);
    exit();
}
?>
