<?php
session_start();

// Redirect to login if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit();
}

// Database connection
$conn = new mysqli("localhost", "root", "", "tuniverse_db");

// Check the connection
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

// Fetch liked songs for the current user
$user_id = $_SESSION['user_id'];
$query = "SELECT song_name FROM liked_songs WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$likedSongs = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Function to search for a song in the music folder and its subfolders
function findSongPath($songName) {
    $musicDir = 'music/';
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($musicDir));

    // Split the song name into song_name and artist_name
    $parts = explode(' - ', $songName);
    if (count($parts) === 2) {
        $songNameOnly = trim($parts[0]); // Extract song name
        $artistName = trim($parts[1]);  // Extract artist name
        $correctFileName = "$artistName - $songNameOnly.mp3"; // Reconstruct the file name in the correct format

        foreach ($iterator as $file) {
            if ($file->isFile() && $file->getFilename() === $correctFileName) {
                return $file->getPathname(); // Return the full path to the song
            }
        }
    }

    return null; // Return null if the song is not found
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tuniverse - Liked Songs</title>
    <link rel="icon" type="image/png" sizes="32x32" href="Images/Logo3.png"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
    <style>
        /* Custom styles for the liked songs page */
        body {
            background-color: #121212; /* Dark background */
            color: #ffffff; /* White text */
            font-family: 'Arial', sans-serif;
        }

        #sidebar {
            background-color: #1c1c1c; /* Dark sidebar */
            color: #ffffff;
        }

        #likedSongsSection {
            padding: 20px;
        }

        #likedSongsList {
            list-style: none;
            padding: 0;
        }

        #likedSongsList li {
            padding: 15px;
            margin-bottom: 10px;
            background-color: #1c1c1c; /* Dark list items */
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        #likedSongsList li:hover {
            background-color: #2c2c2c; /* Hover effect */
        }

        .playButton, .unlikeButton {
            border: none;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .playButton {
            background-color: #dd6165   ; /* Spotify green */
            color: #ffffff;
        }

        .playButton:hover {
            background-color:rgb(227, 118, 121); /* Lighter green on hover */
            transform: scale(1.05);
        }

        .unlikeButton {
            background-color: #ff4d4d; /* Red for unlike */
            color: #ffffff;
        }

        .unlikeButton:hover {
            background-color: #ff6666; /* Lighter red on hover */
            transform: scale(1.05);
        }

        #audioPlayer {
            width: 100%;
            margin-bottom: 20px;
            background-color: #1c1c1c;
            border-radius: 8px;
            border: 1px solid #333;
        }

        h2 {
            color: #1db954; 
            font-weight: bold;
            margin-bottom: 20px;
        }

        .text-muted {
            color: #888 !important; /* Muted text color */
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #1c1c1c;
        }

        ::-webkit-scrollbar-thumb {
            background: #1db954;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #1ed760;
        }
    </style>
</head>
<body>
    <div id="app" class="d-flex flex-column">
        <div id="principal" class="d-flex">
            <!-- Sidebar -->
            <nav id="sidebar" class="w-100 pt-4 d-flex flex-column">
                <!-- Sidebar content -->
            </nav>

            <!-- Main Content -->
            <div id="feed" class="w-100">
                <nav id="topNav" class="d-flex justify-content-between align-items-center px-4 py-2">
                    <!-- Top navigation content -->
                </nav>

                <!-- Liked Songs Section -->
                <main id="main" class="p-4">
                    <section id="likedSongsSection">
                        <h2 class="fw-bold mb-4">Liked Songs</h2>
                        <audio id="audioPlayer" controls style="width: 100%; margin-bottom: 20px;">
                            Your browser does not support the audio element.
                        </audio>
                        <ul id="likedSongsList" class="list-unstyled">
                            <?php if (empty($likedSongs)): ?>
                                <li class="text-muted">No liked songs yet.</li>
                            <?php else: ?>
                                <?php foreach ($likedSongs as $song): ?>
                                    <?php
                                    $songName = $song['song_name'];
                                    $songPath = findSongPath($songName); // Find the song path dynamically
                                    ?>
                                    <li class="d-flex justify-content-between align-items-center py-2">
                                        <span><?= htmlspecialchars($songName) ?></span>
                                        <div>
                                            <?php if ($songPath): ?>
                                                <button class="btn btn-sm btn-outline-primary playButton" data-song="<?= htmlspecialchars($songPath) ?>">
                                                    Play
                                                </button>
                                            <?php else: ?>
                                                <button class="btn btn-sm btn-outline-secondary" disabled>
                                                    File Not Found
                                                </button>
                                            <?php endif; ?>
                                            <button class="btn btn-sm btn-outline-danger unlikeButton" data-song="<?= htmlspecialchars($songName) ?>">
                                                Unlike
                                            </button>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </section>
                </main>
            </div>
        </div>
    </div>

    <!-- Bootstrap and JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const audioPlayer = document.getElementById('audioPlayer');

        // Handle play button clicks
        document.querySelectorAll('.playButton').forEach(button => {
            button.addEventListener('click', () => {
                const songPath = button.dataset.song; // Get the full path to the song
                audioPlayer.src = songPath;
                audioPlayer.play();
            });
        });

        // Handle unlike button clicks
        document.querySelectorAll('.unlikeButton').forEach(button => {
            button.addEventListener('click', async () => {
                const songTitle = button.dataset.song;
                try {
                    const response = await fetch('like_song.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            song_title: songTitle,
                            action: 'unlike'
                        })
                    });

                    if (response.ok) {
                        // Remove the song from the list
                        button.closest('li').remove();

                        // If no songs are left, show a message
                        if (!document.querySelector('#likedSongsList li')) {
                            document.querySelector('#likedSongsList').innerHTML = '<li class="text-muted">No liked songs yet.</li>';
                        }
                    } else {
                        console.error('Failed to unlike song');
                    }
                } catch (error) {
                    console.error('Error unliking song:', error);
                }
            });
        });
    </script>
</body>
</html>