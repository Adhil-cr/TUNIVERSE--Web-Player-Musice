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

  // ✅ Sign-Up Form
  const emailInput = document.getElementById("email");  
  const nextButton = document.getElementById("nextButton");
  const passwordContainer = document.getElementById("passwordContainer");
  const passwordInput = document.getElementById("password");
  const togglePassword = document.getElementById("togglePassword");

  if (emailInput && nextButton && passwordContainer && passwordInput && togglePassword) {
      togglePassword.addEventListener("click", function () {
          passwordInput.type = passwordInput.type === "password" ? "text" : "password";
          togglePassword.innerHTML = passwordInput.type === "password" ? "&#128065;" : "👁";
      });

      emailInput.addEventListener("input", function () {
          const isValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.value.trim());
          nextButton.classList.toggle("active", isValid);
          nextButton.disabled = !isValid;
      });

      nextButton.addEventListener("click", function () {
          if (this.classList.contains("active")) {
              passwordContainer.style.display = "flex";
              this.style.display = "none";
          }
      });
  }

  // ✅ Dropdown Menu
  const dropdownToggle = document.getElementById('dropdownMenuButton1');
  const dropDowns = document.getElementsByClassName('dropdownMenuButton1-dropContent');
  if (dropdownToggle) {
      dropdownToggle.addEventListener('click', () => {
          for (let i = 0; i < dropDowns.length; i++) {
              dropDowns[i].classList.toggle('show');
          }
      });

      window.addEventListener('click', (e) => {
          if (!e.target.matches('#dropdownMenuButton1')) {
              for (let i = 0; i < dropDowns.length; i++) {
                  dropDowns[i].classList.remove('show');
              }
          }
      });
  }
});
