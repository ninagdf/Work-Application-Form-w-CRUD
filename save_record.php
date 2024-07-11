<?php
$servername = "127.0.0.1";
$username = "root";
$password = "nina123456789.";
$dbname = "application";
$port = 3306;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the ID and updated data from the request
$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'];
$updatedData = $data['data'];

// Build the SQL query to update the record
$sql = "UPDATE registration SET ";
foreach ($updatedData as $key => $value) {
    $sql .= "$key = '$value', ";
}
$sql = rtrim($sql, ', ') . " WHERE id = $id";

// Execute the query
if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>
