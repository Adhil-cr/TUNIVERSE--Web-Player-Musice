<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo json_encode(["status" => "error", "message" => "You must be logged in to view liked songs."]);
    exit();
}
header("Content-Type: application/json");

// Database connection
$conn = new mysqli("localhost", "root", "", "tuniverse_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user ID from session
$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    echo json_encode(["status" => "error", "message" => "You must be logged in to view liked songs."]);
    exit();
}

// Fetch liked songs for the user
$stmt = $conn->prepare("SELECT song_name FROM liked_songs WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$songs = [];
while ($row = $result->fetch_assoc()) {
    $songs[] = $row['song_name']; // Add song name to the list
}

if (empty($songs)) {
    echo json_encode(["status" => "success", "message" => "No liked songs found.", "songs" => []]);
} else {
    echo json_encode(["status" => "success", "songs" => $songs]);
}

$stmt->close();
$conn->close();
?>