<?php
session_start();
header("Content-Type: application/json");

// Get album name from URL parameter
$album = isset($_GET['album']) ? trim($_GET['album']) : "";

if ($album !== "") {
    // Define the music directory based on the album name
    $musicDir = "music/" . $album . "/";

    // Check if the directory exists
    if (is_dir($musicDir)) {
        $files = array_diff(scandir($musicDir), array('.', '..'));

        // Prepare an array to store tracks
        $tracks = [];
        foreach ($files as $file) {
            $filePath = $musicDir . $file;
            $tracks[] = ["name" => pathinfo($file, PATHINFO_FILENAME), "src" => $filePath];
        }

        // Output JSON directly
        echo json_encode($tracks, JSON_UNESCAPED_SLASHES);
    } else {
        echo json_encode([]); // Return empty array if album folder doesn't exist
    }
} else {
    echo json_encode([]); // Return empty array if no album is provided
}
exit();
?>

