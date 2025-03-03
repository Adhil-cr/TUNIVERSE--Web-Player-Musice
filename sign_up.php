<?php
// Start a session
session_start();

// Connect to MySQL
$conn = new mysqli("localhost", "root", "", "tuniverse_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    // Validate input fields
    if (!isset($_POST['email'], $_POST['password']) || empty(trim($_POST['email'])) || empty(trim($_POST['password']))) {
        die("Please fill in all fields.");
    }

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    // Hash the password securely
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if the email (username column) already exists
    $stmt = $conn->prepare("SELECT username FROM user_info WHERE username = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->close();
        $conn->close();
        echo "<script>
            alert('User already exists! Please login.');
            window.location.href = 'login.html';
          </script>";
        exit();
    }

    // Insert new user into database
    $stmt = $conn->prepare("INSERT INTO user_info (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $hashed_password);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header("Location: index.html"); // Redirect to login page after successful signup
        exit();
    } else {
        die("Error: " . $stmt->error);
    }
}
?>
