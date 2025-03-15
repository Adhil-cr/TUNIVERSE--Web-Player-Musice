<?php
session_start();
header("Content-Type: application/json");

$album = isset($_GET['album']) ? trim($_GET['album']) : "";

if ($album !== "") {
    $musicDir = "music/" . $album . "/";
    $baseURL = "http://localhost/tuniverse/";

    $albumCover = "assets/" . $album . ".jpg";
    if (!file_exists($albumCover)) {
        $albumCover = "assets/default_cover.jpg";
    }

    if (is_dir($musicDir)) {
        $files = array_diff(scandir($musicDir), array('.', '..'));
        $tracks = [];

        // Debugging: Check if files are detected
        error_log("Scanned files: " . json_encode($files));

        foreach ($files as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) === "mp3") {
                // Encode spaces properly
                $encodedFile = str_replace(" ", "%20", $file);
                $filePath = $baseURL . $musicDir . $encodedFile;
                
                // Extract song name and artist from file name
                $fileName = pathinfo($file, PATHINFO_FILENAME);
                $parts = explode(" - ", $fileName); // Split by " - "
                $songName = $parts[1] ?? $fileName; // Default to full file name if no artist is found
                $author = $parts[0] ?? "Unknown Artist"; // Default to "Unknown Artist" if no artist is found

                $tracks[] = [
                    "name" => $songName,
                    "src" => $filePath,
                    "author" => $author,
                    "duration" => "0:00"
                ];
            }
        }

        echo json_encode([
            "status" => "success",
            "albumCover" => $baseURL . str_replace(" ", "%20", $albumCover),
            "tracks" => $tracks
        ], JSON_UNESCAPED_SLASHES);
    } else {
        echo json_encode(["status" => "error", "message" => "Album not found"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "No album specified"]);
}
exit();
?>