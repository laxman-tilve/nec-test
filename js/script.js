document.addEventListener("DOMContentLoaded", function() {
    const loginForm = document.getElementById("login-form");
    const registerForm = document.getElementById("register-form");
    const loginLink = document.getElementById("login-link");
    const registerLink = document.getElementById("register-link");

    // Function to toggle between login and register forms
    function toggleForms() {
        loginForm.classList.toggle("hidden");
        registerForm.classList.toggle("hidden");
    }

    // Event listeners for switching between forms
    if (loginLink) {
        loginLink.addEventListener("click", function(event) {
            event.preventDefault();
            toggleForms();
        });
    }

    if (registerLink) {
        registerLink.addEventListener("click", function(event) {
            event.preventDefault();
            toggleForms();
        });
    }
});
