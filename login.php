<?php
// Start a session
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "tuniverse_db");

// Check the connection
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Ensure both fields are filled
    if (empty($_POST['username']) || empty($_POST['password'])) {
        die("❌ Please enter both username/email and password.");
    }

    // Trim and sanitize input
    $user_input = trim($_POST['username']); // Can be either email or username
    $password = trim($_POST['password']);

    // Secure query using a prepared statement (check both email and username)
    $stmt = $conn->prepare("SELECT * FROM user_info WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $user_input, $user_input);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a user is found
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            header("Location: index.php");
            exit();
        } else {
            echo "<script>
                alert('❌ Invalid username/email or password.');
                window.location.href = 'login.html';
              </script>";
        }
    } else {
        echo "<script>
            alert('❌ Invalid username/email or password.');
            window.location.href = 'login.html';
          </script>";
    }

    $stmt->close();
}

$conn->close();
?>
