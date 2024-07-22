function validateSignupForm() {
    var password = document.getElementById("password").value;
    var confirm_password = document.getElementById("confirm_password").value;
    var error_message = document.getElementById("error_message");
    
    if (password !== confirm_password) {
        error_message.textContent = "Passwords do not match.";
        return false;
    }
    
    return true;
}
