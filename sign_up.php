<?php
// Start a session
session_start();

// Connect to MySQL
$conn = new mysqli("localhost", "root", "", "tuniverse_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user input
$email = trim($_POST['email']);
$password = trim($_POST['password']);

// Hash the password for security
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

// Check if the email already exists
$stmt = $conn->prepare("SELECT id FROM user_info WHERE username = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo "User already exists! Redirecting to login...";
    header("refresh:2; url=login.html");
} else {
    // Insert new user
    $stmt = $conn->prepare("INSERT INTO user_info (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $hashed_password);
    $stmt->execute();

    echo "Sign-up successful! Redirecting to login...";
    header("refresh:2; url=login.html");
}

$stmt->close();
$conn->close();
?>
