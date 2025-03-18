<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo json_encode(["status" => "error", "message" => "You must be logged in to like songs."]);
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
    echo json_encode(["status" => "error", "message" => "You must be logged in to like songs."]);
    exit();
}

// Get song data from request
$data = json_decode(file_get_contents("php://input"), true);
$song_name = $data['song_name'] ?? ""; // Combined song title and author

// Ensure song data is valid
if (empty($song_name)) {
    echo json_encode(["status" => "error", "message" => "Invalid song data. Please try again."]);
    exit();
}

// Check if the song is already liked
$stmt = $conn->prepare("SELECT id FROM liked_songs WHERE user_id = ? AND song_name = ?");
$stmt->bind_param("is", $user_id, $song_name);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo json_encode(["status" => "error", "message" => "This song is already in your liked songs."]);
    exit();
}

// Add song to liked songs
$stmt = $conn->prepare("INSERT INTO liked_songs (user_id, song_name) VALUES (?, ?)");
$stmt->bind_param("is", $user_id, $song_name);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Song successfully added to your liked songs."]);
} else {
    echo json_encode(["status" => "error", "message" => "Failed to add the song. Please try again."]);
}

$stmt->close();
$conn->close();
?>