<?php
$servername = "127.0.0.1";
$username = "root";
$password = "nina123456789.";
$dbname = "application";
$port = 3306;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to select all records from the registration table
$sql = "SELECT * FROM `registration`";
$result = $conn->query($sql);

// Check if there are any results
if ($result->num_rows > 0) {
    // Store the data in an array
    $records = [];
    while($row = $result->fetch_assoc()) {
        $records[] = $row;
    }
} else {
    echo "0 results";
}
$conn->close();

// Export the records to be used in the HTML file
echo json_encode($records);
?>
