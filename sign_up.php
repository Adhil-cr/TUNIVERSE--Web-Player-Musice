<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start a session
session_start();

// Connect to MySQL
$conn = new mysqli("localhost", "root", "", "tuniverse_db");

// Check connection
if ($conn->connect_error) {
    die("❌ Database Connection Failed: " . $conn->connect_error);
}

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Debug: Check if form data is received
    if (empty($_POST['email']) || empty($_POST['username']) || empty($_POST['password'])) {
        die("❌ Please fill in all fields.");
    }

    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Debug: Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("❌ Invalid email format.");
    }

    // Hash the password securely
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if the email already exists
    $stmt = $conn->prepare("SELECT email FROM user_info WHERE email = ?");
    if (!$stmt) {
        die("❌ Error preparing statement: " . $conn->error);
    }
    
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->close();
        $conn->close();
        echo "<script>
            alert('⚠️ Email already registered! Please login.');
            window.location.href = 'login.html';
          </script>";
        exit();
    }
    $stmt->close();

    // Insert new user into database
    $stmt = $conn->prepare("INSERT INTO user_info (email, username, password) VALUES (?, ?, ?)");
    if (!$stmt) {
        die("❌ Error preparing insert statement: " . $conn->error);
    }

    $stmt->bind_param("sss", $email, $username, $hashed_password);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        echo "<script>
            alert('✅ Welcome to tuniverse.');
            window.location.href = 'index.html';
          </script>";
        exit();
    } else {
        die("❌ Error executing query: " . $stmt->error);
    }
}
?>
