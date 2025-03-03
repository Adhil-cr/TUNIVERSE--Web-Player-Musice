document.addEventListener("DOMContentLoaded", function () {
  console.log("JavaScript loaded successfully!");

  // ✅ Enable/Disable Function
  function enabledisable(element) {
      if (element.style.fill !== "rgb(29, 185, 84)") {
          element.style.setProperty('fill', '#1db954');
      } else {
          element.style.setProperty('fill', '#fff');
      }
  }

  // ✅ Greetings Script
  const greeting = document.getElementById("greeting");
  if (greeting) {
      const hour = new Date().getHours();
      const welcomeTypes = ["Good morning", "Good afternoon", "Good evening"];
      let welcomeText = hour < 12 ? welcomeTypes[0] : hour < 18 ? welcomeTypes[1] : welcomeTypes[2];
      greeting.innerHTML = welcomeText;
  }

  // ✅ Scrolling Navbar
  const nav = document.querySelector("#topNav");
  const sectionOne = document.querySelector(".fw-bold");
  if (nav && sectionOne) {
      const sectionOneObserver = new IntersectionObserver((entries) => {
          entries.forEach(entry => {
              nav.style.backgroundColor = entry.isIntersecting ? "transparent" : "black";
          });
      });
      sectionOneObserver.observe(sectionOne);
  }

  document.getElementById("togglePassword").addEventListener("click", function() {
    let passwordField = document.getElementById("password");
    passwordField.type = (passwordField.type === "password") ? "text" : "password";
});

});


