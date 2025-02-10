<?php
header('Content-Type: application/json');

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "one";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit();
}

$email = $_GET['email'] ?? '';

$sql = "SELECT firstname, lastname, email, phone, address, dob, gender FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    echo json_encode(['success' => true, 'firstname' => $row['firstname'], 'lastname' => $row['lastname'], 'email' => $row['email'], 'phone' => $row['phone'], 'address' => $row['address'], 'dob' => $row['dob'], 'gender' => $row['gender']]);
} else {
    echo json_encode(['success' => false, 'message' => 'User not found']);
}

$stmt->close();
$conn->close();
?>
