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
    let currentPlayButton = null;

    const playIcon = `<svg width="24" height="24" viewBox="0 0 24 24"><path d="M7.05 3.606l13.49 7.788a.7.7 0 010 1.212L7.05 20.394A.7.7 0 016 19.788V4.212a.7.7 0 011.05-.606z" fill="white"></path></svg>`;
    const pauseIcon = `<svg width="24" height="24" viewBox="0 0 24 24"><path d="M3 22h6V2H3v20zM15 2v20h6V2h-6z" fill="white"></path></svg>`;
    const fplayIcon = `<svg width="24" height="24" viewBox="0 0 24 24"><path d="M7.05 3.606l13.49 7.788a.7.7 0 010 1.212L7.05 20.394A.7.7 0 016 19.788V4.212a.7.7 0 011.05-.606z" fill="black"></path></svg>`;
    const fpauseIcon = `<svg width="24" height="24" viewBox="0 0 24 24"><path d="M3 22h6V2H3v20zM15 2v20h6V2h-6z" fill="black"></path></svg>`;
    
    // Footer Elements
    const footerPlayPause = document.querySelector(".playPause");
    const prevButton = document.querySelector(".anterior");
    const nextButton = document.querySelector(".proximo");
    const progressBar = document.querySelector("#barraDeProgresso input[type='range']");
    const currentTimeDisplay = document.querySelector("#barraDeProgresso small:first-child");
    const durationDisplay = document.querySelector("#barraDeProgresso small:last-child");
    const musicDisplay = document.getElementById("musicaPlay");
    const volumeSlider = document.querySelector("#volume input[type='range']");
    const songItems = document.querySelectorAll(".music-item");

    songItems.forEach((item) => {
        item.addEventListener("click", function () {
            // Remove "playing" class from all items
            document.querySelectorAll(".music-item").forEach(el => el.classList.remove("playing"));

            // Add "playing" class to the clicked song
            item.classList.add("playing");
        });
    });

    albumCards.forEach(card => {
        card.addEventListener("click", function () {
            const albumName = this.getAttribute("data-album");

            fetch(`fetch_tracks.php?album=${encodeURIComponent(albumName)}`)
                .then(response => response.json())
                .then(data => {
                    if (data.status === "success" && data.tracks.length > 0) {
                        let trackListHTML = "";

                        data.tracks.forEach((track, index) => {
                            trackListHTML += `<div class="music-item" data-index="${index}">
                                                <button class="play-btn" data-src="${track.src}" data-index="${index}">
                                                    ${playIcon}
                                                </button>
                                                <div class="track-details">
                                                    <span class="track-name">${track.name}</span>
                                                    <span class="track-author">${track.author}</span>
                                                </div>
                                                <span class="track-duration" id="duration-${index}">Loading...</span>
                                                
                                                <!-- Like Button -->
                                                <button class="like-btn" data-index="${index}">
                                                    <svg width="24" height="24" viewBox="0 0 24 24">
                                                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" fill="white"></path>
                                                    </svg>
                                                </button>

                                                <!-- Three-dot Menu -->
                                                <div class="menu-container">
                                                    <button class="menu-btn">⋮</button>
                                                    <div class="menu-dropdown" style="display: none;">
                                                        <button class="add-to-playlist" data-index="${index}">Add to Playlist</button>
                                                    </div>
                                                </div>
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
                    stopCurrentTrack(); // Stop previous track before playing new one
                    audio.src = trackSrc;
                    audio.play().catch(error => console.error("Playback error:", error));
                    isPlaying = true;
                    currentTrackIndex = trackIndex;
                    currentPlayButton = this;
                    this.innerHTML = pauseIcon;

                    updateFooter(tracks[trackIndex]);
                } else {
                    togglePlayPause(this);
                }
            });
        });

        audio.addEventListener("loadedmetadata", function () {
            if (currentTrackIndex !== -1) {
                document.getElementById(`duration-${currentTrackIndex}`).textContent = formatTime(audio.duration);
            }
        });

        audio.addEventListener("ended", function () {
            nextTrack(tracks);
        });

        audio.addEventListener("timeupdate", function () {
            if (!isNaN(audio.duration) && audio.duration > 0) {
                progressBar.value = (audio.currentTime / audio.duration) * 100;
                currentTimeDisplay.textContent = formatTime(audio.currentTime);
                durationDisplay.textContent = formatTime(audio.duration);
            }
        });

        progressBar.addEventListener("input", function () {
            audio.currentTime = (this.value / 100) * audio.duration;
        });

        footerPlayPause.addEventListener("click", function () {
            if (currentPlayButton) {
                togglePlayPause(currentPlayButton);
            } else if (currentTrackIndex !== -1) {
                let trackButton = document.querySelector(`.play-btn[data-index="${currentTrackIndex}"]`);
                if (trackButton) togglePlayPause(trackButton);
            }
        });

        prevButton.addEventListener("click", function () {
            previousTrack(tracks);
        });

        nextButton.addEventListener("click", function () {
            nextTrack(tracks);
        });

        volumeSlider.addEventListener("input", function () {
            let volumeValue = this.value / 100; // Convert range value (0-100) to 0-1
            audio.volume = volumeValue;
        });
        
        fetchDurations(tracks);
    }

    function stopCurrentTrack() {
        if (isPlaying) {
            audio.pause();
            isPlaying = false;
        }

        if (currentPlayButton) {
            currentPlayButton.innerHTML = fplayIcon;
        }
    }

    function togglePlayPause(button) {
        if (!button) return;

        if (isPlaying) {
            audio.pause();
            isPlaying = false;
            button.innerHTML = playIcon;
            footerPlayPause.innerHTML = fplayIcon;
        } else {
            audio.play().then(() => {
                isPlaying = true;
                button.innerHTML = pauseIcon;
                footerPlayPause.innerHTML = fpauseIcon;

                document.querySelectorAll(".play-btn").forEach(btn => {
                    if (btn !== button) btn.innerHTML = playIcon;
                });

                currentPlayButton = button;
            }).catch(error => console.error("Playback error:", error));
        }
    }

    function previousTrack(tracks) {
        if (currentTrackIndex > 0) {
            currentTrackIndex--;
            playTrack(tracks[currentTrackIndex]);
        }
    }

    function nextTrack(tracks) {
        if (currentTrackIndex < tracks.length - 1) {
            currentTrackIndex++;
            playTrack(tracks[currentTrackIndex]);
        } else {
            stopCurrentTrack();
        }
    }

    function playTrack(track) {
        if (!track || !track.src) return;

        stopCurrentTrack();

        audio.src = track.src;
        audio.load();
        audio.play().then(() => {
            isPlaying = true;
            updateFooter(track);

            document.querySelectorAll(".play-btn").forEach(btn => btn.innerHTML = playIcon);

            currentPlayButton = document.querySelector(`.play-btn[data-index="${currentTrackIndex}"]`);
            if (currentPlayButton) currentPlayButton.innerHTML = pauseIcon;

            footerPlayPause.innerHTML = fpauseIcon;
        }).catch(error => console.error("Playback error:", error));
    }

    function updateFooter(track) {
        musicDisplay.innerHTML = `<p>${track.name} - ${track.author}</p>`;
    }

    function fetchDurations(tracks) {
        tracks.forEach((track, index) => {
            let tempAudio = new Audio(track.src);
            tempAudio.addEventListener("loadedmetadata", function () {
                document.getElementById(`duration-${index}`).textContent = formatTime(tempAudio.duration);
            });
        });
    }

    function formatTime(seconds) {
        if (isNaN(seconds)) return "0:00";
        let mins = Math.floor(seconds / 60);
        let secs = Math.floor(seconds % 60);
        return `${mins}:${secs < 10 ? "0" : ""}${secs}`;
    }
});


document.addEventListener("DOMContentLoaded", function () {
    let audio = new Audio();
    let isPlaying = false;
    let currentTrackIndex = -1;
    let currentPlayButton = null;

    // Restore playback state if available
    if (localStorage.getItem("currentTrack")) {
        let savedTrack = JSON.parse(localStorage.getItem("currentTrack"));
        audio.src = savedTrack.src;
        currentTrackIndex = savedTrack.index;
        isPlaying = savedTrack.isPlaying;
        document.getElementById("musicaPlay").innerHTML = `${savedTrack.name} - ${savedTrack.author}`;
    }

    if (isPlaying) {
        audio.play();
    }

    document.querySelectorAll(".play-btn").forEach(button => {
        button.addEventListener("click", function () {
            const trackSrc = this.getAttribute("data-src");
            const trackIndex = parseInt(this.getAttribute("data-index"));
            const trackName = this.closest(".music-item").querySelector(".track-name").textContent;
            const trackAuthor = this.closest(".music-item").querySelector(".track-author").textContent;

            if (currentTrackIndex !== trackIndex) {
                stopCurrentTrack();
                audio.src = trackSrc;
                audio.play().catch(error => console.error("Playback error:", error));
                isPlaying = true;
                currentTrackIndex = trackIndex;
                currentPlayButton = this;
                updateFooter(trackName, trackAuthor);
                saveTrackState(trackSrc, trackIndex, trackName, trackAuthor);
            } else {
                togglePlayPause(this);
            }
        });
    });

    function togglePlayPause(button) {
        if (!button) return;

        if (isPlaying) {
            audio.pause();
            isPlaying = false;
            button.innerHTML = playIcon;
        } else {
            audio.play().then(() => {
                isPlaying = true;
                button.innerHTML = pauseIcon;
                currentPlayButton = button;
            }).catch(error => console.error("Playback error:", error));
        }
    }

    function stopCurrentTrack() {
        if (isPlaying) {
            audio.pause();
            isPlaying = false;
        }
    }

    function updateFooter(name, author) {
        document.getElementById("musicaPlay").innerHTML = `<p>${name} - ${author}</p>`;
    }

    function saveTrackState(src, index, name, author) {
        localStorage.setItem("currentTrack", JSON.stringify({
            src: src,
            index: index,
            name: name,
            author: author,
            isPlaying: isPlaying
        }));
    }

    window.addEventListener("beforeunload", function () {
        localStorage.setItem("isPlaying", isPlaying);
    });

    audio.addEventListener("ended", function () {
        isPlaying = false;
        localStorage.removeItem("currentTrack");
    });

    document.querySelector(".playPause").addEventListener("click", function () {
        if (currentPlayButton) {
            togglePlayPause(currentPlayButton);
        }
    });

    document.querySelector(".anterior").addEventListener("click", function () {
        if (currentTrackIndex > 0) {
            currentTrackIndex--;
            let trackButton = document.querySelector(`.play-btn[data-index="${currentTrackIndex}"]`);
            if (trackButton) trackButton.click();
        }
    });

    document.querySelector(".proximo").addEventListener("click", function () {
        let trackButton = document.querySelector(`.play-btn[data-index="${currentTrackIndex + 1}"]`);
        if (trackButton) {
            currentTrackIndex++;
            trackButton.click();
        }
    });

    document.querySelector("#volume input").addEventListener("input", function () {
        audio.volume = this.value / 100;
    });
});

