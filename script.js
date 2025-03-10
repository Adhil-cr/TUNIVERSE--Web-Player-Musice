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
        window.history.back(); // Goes back to the previous page
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

    albumCards.forEach(card => {
        card.addEventListener("click", function () {
            const albumName = this.getAttribute("data-album"); // Get album name from attribute
            
            fetch(`fetch_tracks.php?album=${encodeURIComponent(albumName)}`) // Send album name to PHP
                .then(response => response.json())
                .then(tracks => {
                    if (tracks.length > 0) {
                        let musicDivs = "";
                        tracks.forEach(track => {
                            musicDivs += `
                                <div class="music-item">
                                    <button type="button" class="btn me-3 play-btn" data-src="${track.src}">
                                        <svg role="img" height="20" width="20" viewBox="0 0 24 24">
                                            <path d="M7.05 3.606l13.49 7.788a.7.7 0 010 1.212L7.05 20.394A.7.7 0 016 19.788V4.212a.7.7 0 011.05-.606z" style="fill: white;"></path>
                                        </svg>
                                    </button>
                                    <span>${track.name}</span>
                                </div>
                            `;
                        });

                        // Update Main Content with Album Details
                        mainContent.innerHTML = `
                            <section id="album-details">
                                <div class="album-header">
                                    <img src="assets/${albumName}.jpg" alt="${albumName} Album">
                                    <div>
                                        <h2>${albumName}</h2>
                                        <p>Various Artists</p>
                                    </div>
                                </div>
                                <div class="tracklist">
                                    ${musicDivs}
                                </div>
                            </section>
                        `;

                        // Attach Event Listeners AFTER Updating the DOM
                        setTimeout(() => {
                            document.querySelectorAll(".play-btn").forEach(button => {
                                button.addEventListener("click", function () {
                                    const audioPlayer = document.querySelector("#audioPlayer");
                                    if (audioPlayer) {
                                        audioPlayer.src = this.getAttribute("data-src");
                                        audioPlayer.play();
                                    } else {
                                        alert("Audio player not found!");
                                    }
                                });
                            });
                        }, 100);
                    } else {
                        console.error("No tracks found.");
                    }
                })
                .catch(error => console.error("Error fetching tracks:", error));
        });
    });
});
