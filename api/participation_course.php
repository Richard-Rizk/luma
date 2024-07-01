<?php
include 'connection.php';

$sql = "
    SELECT 
        Participation.ParticipationId, 
        tbluser.UserName, 
        tbluser.UserId, 
        Participation.traineeId,
        participatedCourse.ParticipateId,
        Course.CourseId
    FROM 
        Participation
    JOIN 
        tbluser ON Participation.ParticipationId = tbluser.UserId
    JOIN 
        participatedCourse ON Participation.ParticipationId = participatedCourse.ParticipateId
    JOIN 
        Course ON participatedCourse.CourseId = Course.CourseId;
";

$result = sqlsrv_query($conn, $sql);

if ($result === false) {
    die(print_r(sqlsrv_errors(), true));
}

$rows = array();
while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
    $rows[] = $row;
}

// Free result set and close connection
sqlsrv_free_stmt($result);
sqlsrv_close($conn);

// Output as JSON
header('Content-Type: application/json');
echo json_encode($rows);
?>
