<?php
require_once('connection.php');

// Check if multiple statuses are provided
$status = isset($_REQUEST["status"]) ? $_REQUEST["status"] : null;
$statusArray = is_array($status) ? $status : ($status ? [$status] : []);

$response = array();

foreach ($statusArray as $status) {
    if ($status == 'readAll') {
        $query = "SELECT * FROM Course";
    }elseif($status == 'readOneCourse'){
        $CourseId=$_REQUEST["CourseId"];
        $query="SELECT * FROM Course WHERE CourseId=$CourseId";
    }elseif($status == 'filterRead'){
        $PortalId=$_REQUEST["PortalId"]; 
        $query="SELECT CourseName,PortalId FROM Course ";
    }elseif ($status == 'readOne') {
        $CourseId = $_REQUEST["CourseId"];
        $query = "SELECT CourseName FROM Course WHERE CourseId=$CourseId";
    } elseif ($status == 'deleteOne') {
        $CourseId = $_REQUEST["CourseId"];
        $query = "DELETE FROM Course WHERE CourseId=$CourseId";
    } elseif ($status == 'updateOne') {
        $CourseId = $_REQUEST["CourseId"];
        $query = "UPDATE Course SET CourseName = 'ajax' WHERE CourseId=$CourseId";
    } elseif ($status == 'new') {
        $CourseName = $_REQUEST["CourseName"];
        $query = "INSERT INTO Course (CourseName) VALUES (N'$CourseName'); SELECT SCOPE_IDENTITY()";
    } elseif ($status == 'highestViews') {
        $query = "SELECT TOP 3 * FROM Course ORDER BY NbofViews DESC";
    } elseif ($status == 'random') {
        $query = "SELECT TOP 3 * FROM Course ORDER BY NEWID()";
    } elseif ($status == 'latestCoursesByStartDate') {
        $query = "SELECT TOP 3 * FROM Course ORDER BY StartDate DESC";
    } else {
        continue; // Skip unknown statuses
    }

    $result = sqlsrv_query($conn, $query);
    
    if ($result === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $arr = array();
    while ($row = sqlsrv_fetch_object($result)) {
        $arr[] = $row;
    }

    if ($status == 'new') {
        sqlsrv_next_result($result);
        sqlsrv_fetch($result);
        $id = sqlsrv_get_field($result, 0);
        $arr['CourseId'] = $id;
    }

    $response[$status] = $arr;
}

echo json_encode($response);
sqlsrv_close($conn);
?>
