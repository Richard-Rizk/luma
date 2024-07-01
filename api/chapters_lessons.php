<?php
require_once('connection.php');

$response = array();

// Check if CourseId is provided
$CourseId = isset($_REQUEST["CourseId"]) ? $_REQUEST["CourseId"] : null;
// Check if LessonId is provided
$LessonId = isset($_REQUEST["LessonId"]) ? $_REQUEST["LessonId"] : null;

// Fetch chapters if CourseId is provided
if ($CourseId !== null) {
    $query = "SELECT * FROM Chapter WHERE CourseId = $CourseId";
    $result = sqlsrv_query($conn, $query);

    if ($result === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $chapters = array();
    while ($row = sqlsrv_fetch_object($result)) {
        $chapter = $row;
        $chapters[] = $chapter;

        // Fetch lessons for the chapter
        $ChapId = $chapter->ChapId;
        $query = "SELECT * FROM Lesson WHERE ChapId = $ChapId";
        $lessonResult = sqlsrv_query($conn, $query);

        if ($lessonResult === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $lessons = array();
        while ($lessonRow = sqlsrv_fetch_object($lessonResult)) {
            $lessons[] = $lessonRow;
        }

        $chapter->lessons = $lessons;
    }

    $response['chapters'] = $chapters;
}

// Fetch lesson details if LessonId is provided
if ($LessonId !== null) {
    $query = "SELECT * FROM Lesson WHERE LessonId = $LessonId";
    $result = sqlsrv_query($conn, $query);

    if ($result === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $lessonDetails = sqlsrv_fetch_object($result);

    if ($lessonDetails !== false) {
        $response['lessonDetails'] = $lessonDetails;
    } else {
        $response['lessonDetails'] = "No lesson found with LessonId: $LessonId";
    }
}

echo json_encode($response);
sqlsrv_close($conn);
?>
