<?php
$servername = "127.0.0.1";
$username = "root"; // replace with your database username
$password = "nina123456789."; // replace with your database password if any
$dbname = "application";
$port = 3306;

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function sanitize($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

$email = sanitize($_POST['email']);
$user_password = sanitize($_POST['password']);

$stmt = $conn->prepare("SELECT password FROM registration WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($stored_password);

if ($stmt->num_rows > 0) {
    $stmt->fetch();
    if ($user_password === $stored_password) {
        header("Location: crudmain.html");
    exit();
    } else {
        echo "Invalid password.";
    }
} else {
    echo "No user found with that email address.";
}

$stmt->close();
$conn->close();
?>
