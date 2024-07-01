
<?php
require('Connection.php');

?>
<?php
// Check connection
if ($conn === false) {
    die(json_encode(array("error" => sqlsrv_errors())));
}

// SQL query to select all records where UserType is 'tr'
$sql = "SELECT * FROM tbluser WHERE UserType='tr'";

$stmt = sqlsrv_query($conn, $sql);

if ($stmt === false) {
    die(json_encode(array("error" => sqlsrv_errors())));
}

$data = array();

if (sqlsrv_has_rows($stmt)) {
    // Output data of each row
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $data[] = $row;
    }
} else {
    $data = array("message" => "0 results");
}

// Close connection
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

// Set the content type to application/json
header('Content-Type: application/json');

// Output the data as JSON
echo json_encode($data);
?>