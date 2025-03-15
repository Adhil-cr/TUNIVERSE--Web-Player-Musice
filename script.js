document.addEventListener("DOMContentLoaded", function () {
    console.log("JavaScript loaded successfully!");

    // ✅ Enable/Disable Function
    function enabledisable(element) {
        element.style.fill = (element.style.fill !== "rgb(29, 185, 84)") ? "#1db954" : "#fff";
    }

    // ✅ Greetings Script
    const greeting = document.getElementById("greeting");
    if (greeting) {
        const hour = new Date().getHours();
        const welcomeTypes = ["Good morning", "Good afternoon", "Good evening"];
        greeting.innerHTML = hour < 12 ? welcomeTypes[0] : hour < 18 ? welcomeTypes[1] : welcomeTypes[2];
    }

    // Navigate back and forward using browser history when arrow buttons are clicked.
    document.getElementById("backButton").addEventListener("click", function () {
        window.location.href = "index.php"; // Goes directly to index.php
    });

    document.getElementById("forwardButton").addEventListener("click", function () {
        window.history.forward(); // Moves forward to the next page
    });

    // ✅ Scrolling Navbar
    const nav = document.querySelector("#topNav");
    const sectionOne = document.querySelector(".fw-bold");
    if (nav && sectionOne) {
        new IntersectionObserver((entries) => {
            nav.style.backgroundColor = entries[0].isIntersecting ? "transparent" : "black";
        }).observe(sectionOne);
    }

    // ✅ Toggle Password Visibility
    const togglePassword = document.getElementById("togglePassword");
    if (togglePassword) {
        togglePassword.addEventListener("click", function () {
            let passwordField = document.getElementById("password");
            passwordField.type = (passwordField.type === "password") ? "text" : "password";
        });
    }
});


document.addEventListener("DOMContentLoaded", function () {
    // ✅ Global Audio Object
    const audio = new Audio();
    let currentTrackIndex = -1;
    let isPlaying = false;
    let currentPlayButton = null;
    let tracks = []; // Store tracks for dynamic playlists

    // ✅ Icons
    const playIcon = `<svg width="24" height="24" viewBox="0 0 24 24"><path d="M7.05 3.606l13.49 7.788a.7.7 0 010 1.212L7.05 20.394A.7.7 0 016 19.788V4.212a.7.7 0 011.05-.606z" fill="white"></path></svg>`;
    const pauseIcon = `<svg width="24" height="24" viewBox="0 0 24 24"><path d="M3 22h6V2H3v20zM15 2v20h6V2h-6z" fill="white"></path></svg>`;

    // ✅ Footer Elements
    const footerPlayPause = document.querySelector(".playPause");
    const prevButton = document.querySelector(".anterior");
    const nextButton = document.querySelector(".proximo");
    const progressBar = document.querySelector("#barraDeProgresso input[type='range']");
    const currentTimeDisplay = document.querySelector("#barraDeProgresso small:first-child");
    const durationDisplay = document.querySelector("#barraDeProgresso small:last-child");
    const musicDisplay = document.getElementById("musicaPlay");
    const volumeSlider = document.querySelector("#volume input[type='range']");

    // ✅ Restore Playback State from localStorage
    const savedState = JSON.parse(localStorage.getItem("playbackState"));
    if (savedState) {
        audio.src = savedState.src;
        audio.currentTime = savedState.currentTime || 0;
        audio.volume = savedState.volume || 1; // Restore volume level
        if (savedState.isPlaying) {
            audio.play().catch(error => console.error("Playback error:", error));
            isPlaying = true;
            footerPlayPause.innerHTML = pauseIcon;
        } else {
            isPlaying = false;
            footerPlayPause.innerHTML = playIcon;
        }
        updateFooter({ name: savedState.trackName, author: savedState.trackAuthor });

        // Restore volume slider position
        if (volumeSlider) {
            volumeSlider.value = savedState.volume * 100;
        }
    }

    // ✅ Save Playback State to localStorage
    function savePlaybackState() {
        const playbackState = {
            src: audio.src,
            currentTime: audio.currentTime,
            isPlaying: isPlaying,
            trackName: musicDisplay.querySelector("#songTitle")?.textContent || "",
            trackAuthor: musicDisplay.querySelector("#songAuthor")?.textContent || "",
            volume: audio.volume, // Save volume level
        };
        localStorage.setItem("playbackState", JSON.stringify(playbackState));
    }

    // ✅ Clear Playback State from localStorage
    function clearPlaybackState() {
        localStorage.removeItem("playbackState");
    }

    // ✅ Reset Playback State
    function resetPlaybackState() {
        audio.pause(); // Stop the audio
        audio.src = ""; // Clear the audio source
        audio.currentTime = 0; // Reset playback position
        audio.volume = 1; // Reset volume to default
        isPlaying = false; // Update playback state
        currentTrackIndex = -1; // Reset track index
        currentPlayButton = null; // Reset play button

        // Reset UI elements
        if (footerPlayPause) footerPlayPause.innerHTML = playIcon;
        if (musicDisplay) musicDisplay.innerHTML = "";
        if (progressBar) progressBar.value = 0;
        if (currentTimeDisplay) currentTimeDisplay.textContent = "00:00";
        if (durationDisplay) durationDisplay.textContent = "00:00";
        if (volumeSlider) volumeSlider.value = 100;

        // Clear playback state from localStorage
        clearPlaybackState();
    }

    // ✅ Handle Page Unload
    window.addEventListener("beforeunload", savePlaybackState);

    // ✅ Logout Event Listener
    const logoutButton = document.getElementById("Logout");
    if (logoutButton) {
        logoutButton.addEventListener("click", function () {
            resetPlaybackState(); // Stop and reset playback on logout
        });
    }

    // ✅ Previous Track Function
    function previousTrack() {
        console.log("Previous button clicked"); // Debugging line
        if (currentTrackIndex > 0) {
            currentTrackIndex--;
            playTrack(tracks[currentTrackIndex]);
        } else {
            console.log("No previous track available."); // Debugging line
        }
    }

    // ✅ Next Track Function
    function nextTrack() {
        console.log("Next button clicked"); // Debugging line
        if (currentTrackIndex < tracks.length - 1) {
            currentTrackIndex++;
            playTrack(tracks[currentTrackIndex]);
        } else {
            console.log("No next track available."); // Debugging line
        }
    }

    // ✅ Attach Event Listeners for Previous/Next Buttons
    prevButton.addEventListener("click", previousTrack);
    nextButton.addEventListener("click", nextTrack);

    // ✅ Top Six Songs Interaction
    const playButtons = document.querySelectorAll(".play-btn");
    playButtons.forEach(button => {
        button.addEventListener("click", function () {
            const trackSrc = this.getAttribute("data-src");
            const trackName = this.closest("li").querySelector("span").textContent;
            const trackAuthor = this.closest("li").querySelector(".track-author")?.textContent || "Unknown Artist";
            playTrack({ src: trackSrc, name: trackName, author: trackAuthor }, this);
        });
    });

    // ✅ Dynamic Playlist Interaction
    const albumCards = document.querySelectorAll(".album-card");
    const mainContent = document.getElementById("main");

    albumCards.forEach(card => {
        card.addEventListener("click", function () {
            const albumName = this.getAttribute("data-album");

            fetch(`fetch_tracks.php?album=${encodeURIComponent(albumName)}`)
                .then(response => response.json())
                .then(data => {
                    if (data.status === "success" && data.tracks.length > 0) {
                        tracks = data.tracks; // Update global tracks variable
                        let trackListHTML = tracks.map((track, index) => `
                            <div class="music-item" data-index="${index}">
                                <button class="play-btn" data-src="${track.src}" data-index="${index}">
                                    ${playIcon}
                                </button>
                                <div class="track-details">
                                    <span class="track-name">${track.name}</span>
                                    <span class="track-author">${track.author}</span>
                                </div>
                                <span class="track-duration" id="duration-${index}">Loading...</span>
                            </div>
                        `).join("");

                        mainContent.innerHTML = `
                            <section id="album-details">
                                <div class="album-card">
                                    <img src="${data.albumCover}" alt="${albumName} Cover" class="album-cover">
                                    <p class="album-name">${albumName}</p>
                                </div>
                                <div class="tracklist">${trackListHTML}</div>
                            </section>
                        `;

                        attachEventListeners();
                    } else {
                        console.error("No tracks found.");
                    }
                })
                .catch(error => console.error("Error fetching tracks:", error));
        });
    });

    // ✅ Attach Event Listeners for Dynamic Playlist
    function attachEventListeners() {
        document.querySelectorAll(".play-btn").forEach(button => {
            button.addEventListener("click", function () {
                const trackSrc = this.getAttribute("data-src");
                const trackIndex = parseInt(this.getAttribute("data-index"));
                playTrack(tracks[trackIndex], this);
            });
        });
    }

    // ✅ Play Track Function
    function playTrack(track, button) {
        if (!track || !track.src) return;

        // Reset the previous play button icon
        if (currentPlayButton && currentPlayButton !== button) {
            currentPlayButton.innerHTML = playIcon;
        }

        if (isPlaying) {
            audio.pause();
        }

        audio.src = track.src;
        audio.load(); // Ensure the audio is loaded before playing
        audio.play().then(() => {
            isPlaying = true;
            currentTrackIndex = tracks.indexOf(track); // Update currentTrackIndex
            currentPlayButton = button || document.querySelector(`.play-btn[data-index="${currentTrackIndex}"]`);
            if (currentPlayButton) currentPlayButton.innerHTML = pauseIcon;
            footerPlayPause.innerHTML = pauseIcon;
            updateFooter(track);

            // Update duration display
            const durationElement = document.getElementById(`duration-${currentTrackIndex}`);
            if (durationElement) {
                durationElement.textContent = formatTime(audio.duration);
            }
        }).catch(error => console.error("Playback error:", error));
    }

    // ✅ Update Footer
    function updateFooter(track) {
        musicDisplay.innerHTML = `<p><span id="songTitle">${track.name}</span> By <span id="songAuthor">${track.author}</span></p>`;
    }

    // ✅ Footer Play/Pause Control
    footerPlayPause.addEventListener("click", function () {
        if (!audio.src) {
            console.error("No track is loaded."); // Debugging line
            return;
        }

        if (isPlaying) {
            console.log("Pausing track..."); // Debugging line
            audio.pause();
            isPlaying = false;
            footerPlayPause.innerHTML = playIcon;
            if (currentPlayButton) currentPlayButton.innerHTML = playIcon;
        } else {
            console.log("Playing track..."); // Debugging line
            audio.play().then(() => {
                isPlaying = true;
                footerPlayPause.innerHTML = pauseIcon;
                if (currentPlayButton) currentPlayButton.innerHTML = pauseIcon;
            }).catch(error => console.error("Playback error:", error));
        }
    });

    // ✅ Progress Bar Update
    audio.addEventListener("timeupdate", function () {
        if (!isNaN(audio.duration)) {
            progressBar.value = (audio.currentTime / audio.duration) * 100;
            currentTimeDisplay.textContent = formatTime(audio.currentTime);
            durationDisplay.textContent = formatTime(audio.duration);
        }
    });

    // ✅ Seek Functionality
    progressBar.addEventListener("input", function () {
        audio.currentTime = (this.value / 100) * audio.duration;
    });

    // ✅ Volume Control
    volumeSlider.addEventListener("input", function () {
        const volume = this.value / 100;
        audio.volume = volume;
        savePlaybackState(); // Save volume level to localStorage
    });

    // ✅ Format Time Helper
    function formatTime(seconds) {
        const mins = Math.floor(seconds / 60);
        const secs = Math.floor(seconds % 60);
        return `${mins}:${secs < 10 ? "0" : ""}${secs}`;
    }

    // ✅ Clear Playback State on Song End
    audio.addEventListener("ended", function () {
        clearPlaybackState();
    });
});