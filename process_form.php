<?php
$servername = "127.0.0.1";
$username = "root"; // database username
$password = "nina123456789."; // database password 
$dbname = "application";
$port = 3306;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize input data
function sanitize($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

$first_name = sanitize($_POST['first_name']);
$last_name = sanitize($_POST['last_name']);
$gender = sanitize($_POST['gender']);
$mobile_no = sanitize($_POST['mobile_no']);
$date_of_birth = sanitize($_POST['date_of_birth']);
$religious_affiliation = sanitize($_POST['religious_affiliation']);
$race = sanitize($_POST['race']);
$pwd = sanitize($_POST['pwd']);
$veteran_status = sanitize($_POST['veteranStatus']);
$email = sanitize($_POST['email']);
$user_password = sanitize($_POST['password']);
$additional_notes = sanitize($_POST['additional_notes']);
$postal_zip_code = sanitize($_POST['postal_zip_code']);
$region = sanitize($_POST['region']);
$province = sanitize($_POST['province']);
$municipality = sanitize($_POST['municipality']);
$barangay = sanitize($_POST['barangay']);
$unit_house_details = sanitize($_POST['unit_house_details']);
$father_name = sanitize($_POST['father_name']);
$mother_name = sanitize($_POST['mother_name']);
$emergency_contact_no = sanitize($_POST['emergency_contact_no']);
$applying_position = sanitize($_POST['applying_position']);
$employment = sanitize($_POST['employment']);

$resume = $_FILES['resume'];
$resume_name = basename($resume['name']);
$target_dir = "uploads/";
$target_file = $target_dir . $resume_name;

if (!move_uploaded_file($resume['tmp_name'], $target_file)) {
    die("Sorry, there was an error uploading your file.");
}

$stmt = $conn->prepare("INSERT INTO registration (first_name, last_name, gender, mobile_no, date_of_birth, religious_affiliation, race, pwd, veteran_status, email, password, additional_notes, postal_zip_code, region, province, municipality, barangay, unit_house_details, father_name, mother_name, emergency_contact_no, applying_position, resume, employment) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssssssssssssssssssss", $first_name, $last_name, $gender, $mobile_no, $date_of_birth, $religious_affiliation, $race, $pwd, $veteran_status, $email, $user_password, $additional_notes, $postal_zip_code, $region, $province, $municipality, $barangay, $unit_house_details, $father_name, $mother_name, $emergency_contact_no, $applying_position, $target_file, $employment);

if ($stmt->execute()) {
    header("Location: index.html"); // Redirect to index.html
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
