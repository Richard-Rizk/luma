<?php
include 'connection.php'

?>
<?php
$sql = "SELECT portalId, portalDesc FROM portal";
$stmt = sqlsrv_query($conn, $sql);

// Check if the query execution was successful
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$data = [];

// Fetch and store each row of data
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $data[] = $row;
}

// Return data as JSON
header('Content-Type: application/json');
echo json_encode($data);

// Free the statement and close the connection
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>