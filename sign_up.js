document.addEventListener("DOMContentLoaded", function () {
  console.log("JavaScript loaded successfully!");

  // ✅ Get Elements
  const emailInput = document.getElementById("email");  
  const nextButton = document.getElementById("nextButton");
  const passwordContainer = document.getElementById("passwordContainer");
  const passwordInput = document.getElementById("password");
  const togglePassword = document.getElementById("togglePassword");

  // ✅ Check if all elements exist in the DOM
  if (!emailInput || !nextButton || !passwordContainer || !passwordInput || !togglePassword) {
      console.error("❌ Error: One or more elements not found in the DOM!");
      return;
  }

  // ✅ Toggle Password Visibility
  togglePassword.addEventListener("click", function () {
      if (passwordInput.type === "password") {
          passwordInput.type = "text"; // Show password
          togglePassword.innerHTML = "👁"; // Open Eye Emoji
      } else {
          passwordInput.type = "password"; // Hide password
          togglePassword.innerHTML = "&#128065;"; // Closed Eye Emoji
      }
  });

  // ✅ Email Validation & Next Button Activation
  emailInput.addEventListener("input", function () {
      let email = this.value.trim();
      let isValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);

      if (isValid) {
          nextButton.classList.add("active");
          nextButton.disabled = false;
      } else {
          nextButton.classList.remove("active");
          nextButton.disabled = true;
      }
  });

  // ✅ Show Password Field When "Next" Button is Clicked
  nextButton.addEventListener("click", function () {
      if (this.classList.contains("active")) {
          passwordContainer.style.display = "flex"; // Show password field
          this.style.display = "none"; // Hide "Next" button
      }
  });
});
