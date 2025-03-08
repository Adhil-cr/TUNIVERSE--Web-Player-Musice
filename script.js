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
    
    // ✅ Handle Click Events and Toggle Play/Pause Without Restarting
    const audioElement = new Audio(); // Global Audio object for playback
    let currentButton = null; // Track the currently playing button
    let currentSongSrc = ""; // Track the currently playing song

    const playButtons = document.querySelectorAll(".play-btn");

    // Play and Pause SVG Paths
    const playIcon = `<path d="M7.05 3.606l13.49 7.788a.7.7 0 010 1.212L7.05 20.394A.7.7 0 016 19.788V4.212a.7.7 0 011.05-.606z"></path>`;
    const pauseIcon = `<path d="M3 22h6V2H3v20zM15 2v20h6V2h-6z"></path>`; // Pause icon

    playButtons.forEach(button => {
        button.addEventListener("click", function () {
            let songSrc = this.getAttribute("data-src"); // Get song source
            let iconSVG = this.querySelector("svg"); // Find the SVG inside button

            if (currentButton === this && !audioElement.paused) {
                // If the same button is clicked and the song is playing, pause it
                audioElement.pause();
                iconSVG.innerHTML = playIcon; // Change to play icon
            } else {
                // If a different song is clicked or the same song was paused
                if (currentSongSrc !== songSrc) {
                    audioElement.src = songSrc;
                    currentSongSrc = songSrc;
                }

                // Stop the previous button's play icon
                if (currentButton && currentButton !== this) {
                    currentButton.querySelector("svg").innerHTML = playIcon;
                }

                audioElement.play();
                iconSVG.innerHTML = pauseIcon; // Change to pause icon
                currentButton = this; // Update the currently playing button
            }

            console.log(audioElement.paused ? "Paused" : "Playing:", songSrc); // Debugging log
        });
    });

    // ✅ Handle event when song ends (reset icon)
    audioElement.addEventListener("ended", function () {
        if (currentButton) {
            currentButton.querySelector("svg").innerHTML = playIcon; // Reset to play icon
        }
    });

});