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


// Function to sanitize input data
function sanitize($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Get the ID and other data from the request
$id = intval($_POST['id']);
$first_name = sanitize($_POST['first_name']);
$last_name = sanitize($_POST['last_name']);
$gender = sanitize($_POST['gender']);
$mobile_no = sanitize($_POST['mobile_no']);
$date_of_birth = sanitize($_POST['date_of_birth']);
$religious_affiliation = sanitize($_POST['religious_affiliation']);
$race = sanitize($_POST['race']);
$pwd = sanitize($_POST['pwd']);
$veteran_status = sanitize($_POST['veteran_status']);
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
// Assume resume is not updated in this operation

// SQL query to update the record
$sql = "UPDATE registration SET first_name = ?, last_name = ?, gender = ?, mobile_no = ?, date_of_birth = ?, religious_affiliation = ?, race = ?, pwd = ?, veteran_status = ?, email = ?, password = ?, additional_notes = ?, postal_zip_code = ?, region = ?, province = ?, municipality = ?, barangay = ?, unit_house_details = ?, father_name = ?, mother_name = ?, emergency_contact_no = ?, applying_position = ?, employment = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssssssssssssssssssi", $first_name, $last_name, $gender, $mobile_no, $date_of_birth, $religious_affiliation, $race, $pwd, $veteran_status, $email, $user_password, $additional_notes, $postal_zip_code, $region, $province, $municipality, $barangay, $unit_house_details, $father_name, $mother_name, $emergency_contact_no, $applying_position, $employment, $id);

if ($stmt->execute()) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
