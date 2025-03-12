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
        
        // ✅ Global Audio Object
    const audioElement = new Audio();
    let currentButton = null;
    let currentSongSrc = "";

    // ✅ Select Elements
    const playButtons = document.querySelectorAll(".play-btn");
    const musicaPlay = document.getElementById("musicaPlay"); // Footer Song Display
    const footerPlayPause = document.querySelector("#caixaSetas .playPause svg"); // Footer Play/Pause Icon
    const footerPlayPauseBtn = document.querySelector("#caixaSetas .playPause"); // Footer Play/Pause Button
    const progressBar = document.querySelector("#barraDeProgresso input"); // Progress Bar
    const progressTimeStart = document.querySelector("#barraDeProgresso small:first-child"); // Start time
    const progressTimeEnd = document.querySelector("#barraDeProgresso small:last-child"); // End time
    const volumeControl = document.querySelector("#volume input"); // Volume Slider
    const volumeIcon = document.querySelector("#volume-icon"); // Volume Icon

    // ✅ Play/Pause Icons
    const playIcon = `<path d="M7.05 3.606l13.49 7.788a.7.7 0 010 1.212L7.05 20.394A.7.7 0 016 19.788V4.212a.7.7 0 011.05-.606z"></path>`;
    const pauseIcon = `<path d="M3 22h6V2H3v20zM15 2v20h6V2h-6z"></path>`;

    // ✅ Handle Click Events for Individual Song Buttons
    playButtons.forEach(button => {
        button.addEventListener("click", function () {
            let songSrc = this.getAttribute("data-src");
            let iconSVG = this.querySelector("svg");

            if (currentButton === this && !audioElement.paused) {
                audioElement.pause();
                iconSVG.innerHTML = playIcon;
                footerPlayPause.innerHTML = playIcon;
            } else {
                if (currentSongSrc !== songSrc) {
                    audioElement.src = songSrc;
                    currentSongSrc = songSrc;
                    updateSongInfo(songSrc);
                    audioElement.currentTime = 0; // Reset to start
                }

                if (currentButton && currentButton !== this) {
                    currentButton.querySelector("svg").innerHTML = playIcon;
                }

                audioElement.play();
                iconSVG.innerHTML = pauseIcon;
                footerPlayPause.innerHTML = pauseIcon;
                currentButton = this;
            }
        });
    });

    // ✅ Update Footer with Song Name
    function updateSongInfo(songSrc) {
        let songName = songSrc.split("/").pop().replace(".mp3", ""); // Extract file name
        musicaPlay.innerHTML = `<strong>${songName}</strong>`;
    }

    // ✅ Footer Play/Pause Control
    footerPlayPauseBtn.addEventListener("click", function () {
        if (!currentSongSrc) return; // Prevent play/pause when no song is selected

        if (audioElement.paused) {
            audioElement.play();
            footerPlayPause.innerHTML = pauseIcon;
            if (currentButton) {
                currentButton.querySelector("svg").innerHTML = pauseIcon;
            }
        } else {
            audioElement.pause();
            footerPlayPause.innerHTML = playIcon;
            if (currentButton) {
                currentButton.querySelector("svg").innerHTML = playIcon;
            }
        }
    });

    // ✅ Update Progress Bar as Song Plays
    audioElement.addEventListener("timeupdate", function () {
        if (audioElement.duration) {
            let progress = (audioElement.currentTime / audioElement.duration) * 100;
            progressBar.value = progress;
            progressTimeStart.textContent = formatTime(audioElement.currentTime);
            progressTimeEnd.textContent = formatTime(audioElement.duration);
        }
    });

    // ✅ Seek Song When Progress Bar Changes
    progressBar.addEventListener("input", function () {
        if (audioElement.duration) {
            audioElement.currentTime = (this.value / 100) * audioElement.duration;
        }
    });

    // ✅ Format Time Helper Function
    function formatTime(seconds) {
        let minutes = Math.floor(seconds / 60);
        let secs = Math.floor(seconds % 60);
        return `${minutes}:${secs < 10 ? "0" + secs : secs}`;
    }

    // ✅ Volume Control
    volumeControl.addEventListener("input", function () {
        let volume = this.value / 100;
        audioElement.volume = volume;
        updateVolumeIcon(volume);
    });

    // ✅ Update Volume Icon
    function updateVolumeIcon(volume) {
        if (volume === 0) {
            volumeIcon.innerHTML = `<path d="M9.741.85a.75.75 0 01.375.65v13a.75.75 0 01-1.125.65l-6.925-4a3.642 3.642 0 01-1.33-4.967 3.639 3.639 0 011.33-1.332l6.925-4a.75.75 0 01.75 0zM1.5 7.5l5.8-3.35v6.7l-5.8-3.35z"></path>`; // Muted
        } else if (volume < 0.5) {
            volumeIcon.innerHTML = `<path d="M9.741.85a.75.75 0 01.375.65v13a.75.75 0 01-1.125.65l-6.925-4a3.642 3.642 0 01-1.33-4.967 3.639 3.639 0 011.33-1.332l6.925-4a.75.75 0 01.75 0zM1.5 7.5l5.8-3.35v6.7l-5.8-3.35zm9.3 3.3a2.5 2.5 0 000-4.8v1.5a1 1 0 010 1.8v1.5z"></path>`; // Low Volume
        } else {
            volumeIcon.innerHTML = `<path d="M9.741.85a.75.75 0 01.375.65v13a.75.75 0 01-1.125.65l-6.925-4a3.642 3.642 0 01-1.33-4.967 3.639 3.639 0 011.33-1.332l6.925-4a.75.75 0 01.75 0zM1.5 7.5l5.8-3.35v6.7l-5.8-3.35zm9.3 3.3a4.502 4.502 0 000-8.474v1.65a2.999 2.999 0 010 5.175v1.649z"></path>`; // High Volume
        }
    }

    // ✅ Reset Icons When Song Ends
    audioElement.addEventListener("ended", function () {
        if (currentButton) {
            currentButton.querySelector("svg").innerHTML = playIcon;
        }
        footerPlayPause.innerHTML = playIcon;
    });

    

}); 
document.addEventListener("DOMContentLoaded", function () {
    const albumCards = document.querySelectorAll(".album-card");
    const mainContent = document.getElementById("main");
    let audio = new Audio();
    let currentTrackIndex = -1;
    let isPlaying = false;
    let currentPlayButton = null; // Track the current playing button

    const playIcon = `<svg width="24" height="24" viewBox="0 0 24 24"><path d="M7.05 3.606l13.49 7.788a.7.7 0 010 1.212L7.05 20.394A.7.7 0 016 19.788V4.212a.7.7 0 011.05-.606z" fill="white"></path></svg>`;
    const pauseIcon = `<svg width="24" height="24" viewBox="0 0 24 24"><path d="M3 22h6V2H3v20zM15 2v20h6V2h-6z" fill="white"></path></svg>`;

    albumCards.forEach(card => {
        card.addEventListener("click", function () {
            const albumName = this.getAttribute("data-album");

            fetch(`fetch_tracks.php?album=${encodeURIComponent(albumName)}`)
                .then(response => response.json())
                .then(data => {
                    if (data.status === "success" && data.tracks.length > 0) {
                        let trackListHTML = "";

                        data.tracks.forEach((track, index) => {
                            trackListHTML += `
                                <div class="music-item" data-index="${index}">
                                    <button class="play-btn" data-src="${track.src}" data-index="${index}">
                                        ${playIcon}
                                    </button>
                                    <div class="track-details">
                                        <span class="track-name">${track.name}</span>
                                        <span class="track-author">${track.author}</span>
                                    </div>
                                    <span class="track-duration" id="duration-${index}">${track.duration}</span>
                                </div>
                            `;
                        });

                        mainContent.innerHTML = `
                            <section id="album-details">
                                <div class="album-card">
                                    <img src="${data.albumCover}" alt="${albumName} Cover" class="album-cover">
                                    <p class="album-name">${albumName}</p>
                                </div>
                                <div class="tracklist">${trackListHTML}</div>
                            </section>
                        `;
                        attachEventListeners(data.tracks);
                    } else {
                        console.error("No tracks found.");
                    }
                })
                .catch(error => console.error("Error fetching tracks:", error));
        });
    });

    function attachEventListeners(tracks) {
        document.querySelectorAll(".play-btn").forEach(button => {
            button.addEventListener("click", function () {
                const trackSrc = this.getAttribute("data-src");
                const trackIndex = parseInt(this.getAttribute("data-index"));

                if (currentTrackIndex !== trackIndex) {
                    if (currentPlayButton) {
                        currentPlayButton.innerHTML = playIcon; // Reset previous button
                    }
                    audio.src = trackSrc;
                    audio.play().catch(error => console.error("Playback error:", error));
                    isPlaying = true;
                    currentTrackIndex = trackIndex;
                    currentPlayButton = this;
                    this.innerHTML = pauseIcon;
                } else {
                    if (isPlaying) {
                        audio.pause();
                        isPlaying = false;
                        this.innerHTML = playIcon;
                    } else {
                        audio.play();
                        isPlaying = true;
                        this.innerHTML = pauseIcon;
                    }
                }
            });
        });

        audio.addEventListener("ended", function () {
            if (currentPlayButton) {
                currentPlayButton.innerHTML = playIcon;
            }
            isPlaying = false;
        });

        fetchDurations(tracks);
    }

    function fetchDurations(tracks) {
        tracks.forEach((track, index) => {
            let tempAudio = new Audio(track.src);
            tempAudio.addEventListener("loadedmetadata", function () {
                let duration = formatTime(tempAudio.duration);
                document.getElementById(`duration-${index}`).textContent = duration;
            });
        });
    }

    function formatTime(seconds) {
        let mins = Math.floor(seconds / 60);
        let secs = Math.floor(seconds % 60);
        return `${mins}:${secs < 10 ? "0" : ""}${secs}`;
    }
});
