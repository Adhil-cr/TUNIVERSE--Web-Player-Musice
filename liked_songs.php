<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit();
}

$conn = new mysqli("localhost", "root", "", "tuniverse_db");
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];
$query = "SELECT song_name FROM liked_songs WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$likedSongs = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

function findSongPath($songName) {
    $musicDir = 'music/';
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($musicDir));
    $parts = explode(' - ', $songName);
    if (count($parts) === 2) {
        $songNameOnly = trim($parts[0]);
        $artistName = trim($parts[1]);
        $correctFileName = "$artistName - $songNameOnly.mp3";
        foreach ($iterator as $file) {
            if ($file->isFile() && $file->getFilename() === $correctFileName) {
                return $file->getPathname();
            }
        }
    }
    return null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liked Song's</title>
    <link rel="icon" type="image/png" sizes="32x32" href="Images/Logo3.png"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
    crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <style>
    :root {
        --background-primary: #000000;
        --background-secondary: rgba(18, 18, 18, 0.95);
        --text-primary: #ffffff;
        --text-secondary: #b3b3b3;
        --accent-color: #ffffff;
        --hover-bg: rgba(255, 255, 255, 0.08);
        --glass-bg: rgba(40, 40, 40, 0.6);
    }

    body {
        background: linear-gradient(180deg, #121212 0%, #000000 100%);
        color: var(--text-primary);
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        height: 100vh;
        overflow: hidden;
    }

    /* --------- Sidebar --------- */
    #sidebar {
        width: 280px;
        height: 100vh;
        background: var(--glass-bg);
        padding: 24px 20px;
        position: fixed;
        backdrop-filter: blur(16px);
        border-right: 1px solid rgba(255, 255, 255, 0.1);
    }

    .sidebar-header {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 0 12px 24px 12px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        margin-bottom: 24px;
    }

    .sidebar-header img {
        width: 40px;
        height: 40px;
        border-radius: 8px;
    }

    .logo-text {
        font-size: 1.4rem;
        font-weight: 600;
        letter-spacing: -1px;
        color: var(--text-primary);
    }

    .nav-link {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 12px 16px;
        margin: 4px 0;
        color: var(--text-secondary);
        border-radius: 8px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .nav-link svg {
        width: 24px;
        height: 24px;
        flex-shrink: 0;
    }

    .nav-link:hover {
        background: var(--hover-bg);
        color: var(--text-primary);
        transform: translateX(4px);
    }

    /* --------- Main Content --------- */
    .main-content {
        margin-left: 280px;
        padding: 40px 32px;
        height: calc(100vh - 120px);
        overflow-y: auto;
    }

    .main-content header {
        display: flex;
        align-items: center;
        gap: 24px;
        margin-bottom: 32px;
        padding: 16px 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .main-content h1 {
        font-size: 2.4rem;
        margin: 0;
        letter-spacing: -0.03em;
    }

    .song-list {
        margin-top: 32px;
        padding-right: 20px;
    }

    .song-item {
        display: flex;
        align-items: center;
        padding: 16px 24px;
        margin-bottom: 8px;
        border-radius: 6px;
        background: transparent;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .song-item:hover {
        background: var(--hover-bg);
        transform: translateX(8px);
    }

        /* --------- Playback Controls --------- */
    .playback-controls {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 16px;
        margin-top: 20px;
    }

    .control-button {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;    
        background: rgba(255, 255, 255, 0);
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .control-button svg {
        width: 24px;
        height: 24px;
        fill: #ffffff;
    }

    .control-button:hover {
        background:rgba(221, 97, 101, 0.51);
        transform: scale(1.1);
    }

    /* Play/Pause button specifically */
    .play-pause-button {
        width: 64px;
        height: 64px;
        background: #ffffff;
        box-shadow: 0 4px 16px rgba(255, 255, 255, 0.3);
    }

    .play-pause-button svg {
        fill: #000000;
    }

    .play-pause-button:hover {
        transform: scale(1.15);
    }


        /* --------- Progress & Utilities --------- */
        .progress-bar {
        width: 100%;
        height: 6px; /* Increase height */
        background: rgba(255, 255, 255, 0.2); /* Slightly visible when empty */
        border-radius: 3px;
        position: relative;
    }


        .progress-filled {
        width: 0%; /* Start empty */
        height: 100%;
        transition: width 0.3s ease-in-out;
        background-color: #dd6165;
    }

    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: rgba(0, 0, 0, 0.2);
    }

    ::-webkit-scrollbar-thumb {
        background: var(--text-secondary);
        border-radius: 4px;
    }
    /* Volume Slider Styles */
    #volume-slider {
        height: 4px;
        background: rgba(255, 255, 255, 0.2);
        cursor: pointer;
        transition: all 0.2s ease;
    }

    #volume-slider:hover {
        height: 6px;
    }

    #volume-slider::-webkit-slider-thumb {
        -webkit-appearance: none;
        width: 12px;
        height: 12px;
        background: #fff;
        border-radius: 50%;
        transition: all 0.2s ease;
    }

    #volume-slider::-moz-range-thumb {
        width: 12px;
        height: 12px;
        background: #fff;
        border-radius: 50%;
        border: none;
    }
</style>
</head>
<body>
    <!-- Sidebar -->
<div id="sidebar">
    <div class="logo-container">
        <img src="Images/Logo3.png" alt="Tuniverse Logo">
        <span class="logo-text">TUNIVERSE</span>
    </div>

    <nav class="nav flex-column">
        <a href="index.php" class="nav-link">
            <svg viewBox="0 0 24 24" fill="currentColor">
                <path d="M13.5 1.515a3 3 0 00-3 0L3 5.845a2 2 0 00-1 1.732V21a1 1 0 001 1h6a1 1 0 001-1v-6h4v6a1 1 0 001 1h6a1 1 0 001-1V7.577a2 2 0 00-1-1.732l-7.5-4.33z"/>
            </svg>
            Home
        </a>
    </nav>
</div>

    <!-- Main Content -->
    <div class="main-content">
        <h1 class="mb-4">Liked Songs</h1>
        <div class="song-list">
            <?php if (empty($likedSongs)): ?>
                <div class="text-muted">No liked songs yet.</div>
            <?php else: ?>
                <?php foreach ($likedSongs as $song): ?>
                    <?php $songPath = findSongPath($song['song_name']); ?>
                    <div class="song-item d-flex justify-content-between align-items-center">
                        <div>
                            <div class="song-title"><?= explode(' - ', $song['song_name'])[0] ?></div>
                            <div class="song-artist"><?= explode(' - ', $song['song_name'])[1] ?? 'Unknown Artist' ?></div>
                        </div>
                        <div class="d-flex align-items-center">
                            <?php if ($songPath): ?>
                                <button class="control-button play-button" data-song="<?= htmlspecialchars($songPath) ?>">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M7.05 3.606l13.49 7.788a.7.7 0 010 1.212L7.05 20.394A.7.7 0 016 19.788V4.212a.7.7 0 011.05-.606z"/>
                                    </svg>
                                </button>
                            <?php else: ?>
                                <button class="control-button" disabled>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                                    </svg>
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Footer Music Controls -->
    <div id="footer">
        <div class="container-fluid">
            <div class="row align-items-center">
                <!-- Current Song Info -->
                <div class="col-3">
                    <div class="d-flex align-items-center">
                        <div class="ms-3">
                            <div id="current-song-title" class="song-title">No song playing</div>
                            <div id="current-song-artist" class="song-artist">–</div>
                        </div>
                    </div>
                </div>

                <!-- Playback Controls -->
                <div class="col-6">
                    <div class="d-flex flex-column align-items-center">
                        <div class="d-flex align-items-center mb-2">
                            <button class="control-button" id="prev-button">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M6 6h2v12H6zm3.5 6l8.5 6V6z"/>
                                </svg>
                            </button>
                            
                            <button class="control-button play-button" id="play-pause-button">
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M7.05 3.606l13.49 7.788a.7.7 0 010 1.212L7.05 20.394A.7.7 0 016 19.788V4.212a.7.7 0 011.05-.606z"/>
                                </svg>
                            </button>
                            
                            <button class="control-button" id="next-button">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M6 18l8.5-6L6 6v12zM16 6v12h2V6h-2z"/>
                                </svg>
                            </button>
                        </div>
                        <div class="w-100 d-flex align-items-center">
                            <small class="me-2">0:00</small>
                            <div class="progress-bar flex-grow-1">
                                <div class="progress-filled"></div>
                            </div>
                            <small class="ms-2">0:00</small>
                        </div>
                    </div>
                </div>

                <!-- Additional Controls -->
                <!-- Add this to the Additional Controls section in the footer -->
                <div class="col-3 d-flex justify-content-end align-items-center">
                    <div class="d-flex align-items-center gap-2" style="width: 150px;">
                        <button class="control-button" id="volume-button">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M14.56 4.677a1 1 0 011.11.832L16 5.78v12.533a1 1 0 01-1.555.832L9 14.202H5a2 2 0 01-2-2v-4a2 2 0 012-2h4l4.445-3.306a1 1 0 011.115-.12zM18 9.002a1 1 0 011 1v4a1 1 0 11-2 0v-4a1 1 0 011-1z"/>
                            </svg>
                        </button>
                        <input type="range" id="volume-slider" class="form-range" min="0" max="1" step="0.01" value="1" style="width: 100px;">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const audio = new Audio(); // Audio object to handle playback
        let currentSongIndex = 0; // Track the current song index
        let isDraggingProgress = false; // Track if the user is dragging the progress bar

        // Get all songs from the PHP output
        const songs = Array.from(document.querySelectorAll('[data-song]')).map(button => ({
            path: button.dataset.song, // Path to the song file
            title: button.closest('.song-item').querySelector('.song-title').textContent, // Song title
            artist: button.closest('.song-item').querySelector('.song-artist').textContent // Song artist
        }));

        // Player elements
        const playPauseButton = document.getElementById('play-pause-button'); // Play/Pause button
        const prevButton = document.getElementById('prev-button'); // Previous button
        const nextButton = document.getElementById('next-button'); // Next button
        const progressBar = document.querySelector('.progress-bar'); // Progress bar container
        const progressFilled = document.querySelector('.progress-filled'); // Progress bar filled portion
        const timeCurrent = document.querySelector('small:first-child'); // Current time display
        const timeTotal = document.querySelector('small:last-child'); // Total time display
        const volumeSlider = document.getElementById('volume-slider'); // Volume slider
        const volumeButton = document.getElementById('volume-button'); // Volume button

        // Helper function to format time (e.g., 125 -> "2:05")
        function formatTime(seconds) {
            const minutes = Math.floor(seconds / 60);
            seconds = Math.floor(seconds % 60);
            return `${minutes}:${seconds.toString().padStart(2, '0')}`;
        }

        // Update the player UI with the current song's title, artist, and duration
        function updatePlayerUI() {
            document.getElementById('current-song-title').textContent = songs[currentSongIndex].title;
            document.getElementById('current-song-artist').textContent = songs[currentSongIndex].artist;
            timeTotal.textContent = formatTime(audio.duration || 0);
        }

        // Update the play/pause button icon based on the current state
        function updatePlayPauseButton() {
            console.log("Updating play/pause button. audio.paused:", audio.paused); // Debugging
            playPauseButton.innerHTML = audio.paused ? `
                <svg width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M7.05 3.606l13.49 7.788a.7.7 0 010 1.212L7.05 20.394A.7.7 0 016 19.788V4.212a.7.7 0 011.05-.606z"/> <!-- Play icon -->
                </svg>` : `
                <svg width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M6 4h4v16H6zm8 0h4v16h-4z"/> <!-- Pause icon -->
                </svg>`;
        }

        // Load and play a song by index
        function loadSong(index, autoplay = true) {
            if (index < 0 || index >= songs.length) return; // Check if the index is valid

            currentSongIndex = index;
            audio.src = songs[index].path; // Set the audio source

            if (autoplay) {
                audio.play(); // Play the song
            }

            updatePlayerUI(); // Update the UI
            updatePlayPauseButton(); // Update the play/pause button
        }

        // Play/Pause button click handler
        playPauseButton.addEventListener('click', () => {
            console.log("Play/Pause button clicked. audio.paused:", audio.paused); // Debugging
            if (audio.paused) {
                audio.play(); // Play the song
            } else {
                audio.pause(); // Pause the song
            }
            // No need to call updatePlayPauseButton here; it will be handled by the 'play' and 'pause' event listeners
        });

        // Previous button click handler
        prevButton.addEventListener('click', () => {
            currentSongIndex = (currentSongIndex - 1 + songs.length) % songs.length; // Loop to the last song if at the first song
            loadSong(currentSongIndex); // Load the previous song
        });

        // Next button click handler
        nextButton.addEventListener('click', () => {
            currentSongIndex = (currentSongIndex + 1) % songs.length; // Loop to the first song if at the last song
            loadSong(currentSongIndex); // Load the next song
        });

        // Song item click handler (play the clicked song)
        document.querySelectorAll('.song-item').forEach((item, index) => {
            item.addEventListener('click', () => {
                loadSong(index); // Load the clicked song
            });
        });

        // Initialize the first song if available
        if (songs.length > 0) {
            audio.src = songs[0].path; // Set the first song as the initial source
            audio.addEventListener('loadedmetadata', () => {
                timeTotal.textContent = formatTime(audio.duration); // Update the total time display
            });
            updatePlayerUI(); // Update the UI
        }

        // Progress bar click handler (seek to a specific time)
        progressBar.addEventListener('click', (e) => {
            const rect = progressBar.getBoundingClientRect();
            const pos = (e.clientX - rect.left) / rect.width; // Calculate the clicked position
            audio.currentTime = pos * audio.duration; // Set the audio's current time
        });

        // Update the progress bar as the song plays
        audio.addEventListener('timeupdate', () => {
            if (!isDraggingProgress) {
                const progress = (audio.currentTime / audio.duration) * 100; // Calculate the progress percentage
                progressFilled.style.width = `${progress}%`; // Update the progress bar width
                timeCurrent.textContent = formatTime(audio.currentTime); // Update the current time display
            }
        });

        // Automatically play the next song when the current one ends
        audio.addEventListener('ended', () => {
            currentSongIndex = (currentSongIndex + 1) % songs.length; // Move to the next song
            loadSong(currentSongIndex); // Load the next song
        });

        // Progress bar drag handling
        progressBar.addEventListener('mousedown', () => (isDraggingProgress = true)); // Start dragging
        document.addEventListener('mouseup', () => (isDraggingProgress = false)); // Stop dragging

        // Volume slider input handler
        volumeSlider.addEventListener('input', (e) => {
            audio.volume = e.target.value; // Set the volume
            updateVolumeIcon(); // Update the volume icon
        });

        // Volume button click handler (mute/unmute)
        volumeButton.addEventListener('click', () => {
            if (audio.volume > 0) {
                audio.volume = 0; // Mute the audio
                volumeSlider.value = 0;
            } else {
                audio.volume = 1; // Unmute the audio
                volumeSlider.value = 1;
            }
            updateVolumeIcon(); // Update the volume icon
        });

        // Update the volume icon based on the volume level
        function updateVolumeIcon() {
            const volumeLevel = audio.volume;
            const iconPaths = [
                'M16 9.002a1 1 0 011 1v4a1 1 0 11-2 0v-4a1 1 0 011-1zM14.56 4.677a1 1 0 011.11.832L16 5.78v12.533a1 1 0 01-1.555.832L9 14.202H5a2 2 0 01-2-2v-4a2 2 0 012-2h4l4.445-3.306a1 1 0 011.115-.12z', // Muted
                'M14.56 4.677a1 1 0 011.11.832L16 5.78v12.533a1 1 0 01-1.555.832L9 14.202H5a2 2 0 01-2-2v-4a2 2 0 012-2h4l4.445-3.306a1 1 0 011.115-.12zM18 9.002a1 1 0 011 1v4a1 1 0 11-2 0v-4a1 1 0 011-1z', // Low volume
                'M14.56 4.677a1 1 0 011.11.832L16 5.78v12.533a1 1 0 01-1.555.832L9 14.202H5a2 2 0 01-2-2v-4a2 2 0 012-2h4l4.445-3.306a1 1 0 011.115-.12zM18 9.002a1 1 0 011 1v4a1 1 0 11-2 0v-4a1 1 0 011-1zM20 8a1 1 0 011 1v6a1 1 0 11-2 0V9a1 1 0 011-1z' // High volume
            ];

            // Set the appropriate icon based on the volume level
            volumeButton.querySelector('path').setAttribute('d', iconPaths[audio.volume === 0 ? 0 : (audio.volume < 0.5 ? 1 : 2)]);
        }

        // Initialize the volume icon
        updateVolumeIcon();

        // Add event listeners for 'play' and 'pause' to update the button
        audio.addEventListener('play', () => {
            console.log("Audio played. audio.paused:", audio.paused); // Debugging
            updatePlayPauseButton();
        });

        audio.addEventListener('pause', () => {
            console.log("Audio paused. audio.paused:", audio.paused); // Debugging
            updatePlayPauseButton();
        });
    });
</script>

</body>
</html>