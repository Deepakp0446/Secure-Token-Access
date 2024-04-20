<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Signup Page</title>
<style>
    /* Basic styles */
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        margin: 0;
        padding: 0;
    }

    /* Signup form styles */
    .container {
        max-width: 400px;
        margin: 50px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        position: relative; /* To keep stars behind */
    }
    h2 {
        text-align: center;
    }
    .form-group {
        margin-bottom: 20px;
    }
    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }
    input[type="text"],
    input[type="password"],
    input[type="tel"],
    select {
        width: 95%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }
    input[type="checkbox"] {
        margin-right: 5px;
    }
    .show-password {
        margin-left: 10px;
    }
    .form-group:last-child {
        margin-bottom: 0;
    }
    button {
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        border: none;
        color: #fff;
        border-radius: 3px;
        cursor: pointer;
    }
    button:hover {
        background-color: #0056b3;
    }

    /* OTP Field */
    #otpField {
        display: none;
    }

</style>
</head>
<body>

<div class="container">
    <h2>Signup Form</h2>
    <form action="../includes/register.inc.php" method="post" id="signupForm">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="confirmPassword">Confirm Password:</label>
            <input type="password" id="confirmPassword" name="confirmPassword" required>
            <span id="passwordMatch" style="display: none; color:red;">Passwords do not match</span>
        </div>
        <div class="form-group">
            <label for="phoneNumber">Phone Number:</label>
            <input type="tel" id="phoneNumber" name="phoneNumber" maxlength="10" required>
        </div>
        
        <a href="otp.php"><button type="submit" id="subbtn" >Signup</button></a>
    </form>
    <div class="form-group">
        <center><a href="index.php">Already have an account? Login Here</a></center>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirmPassword');
    const passwordMatchMessage = document.getElementById('passwordMatch');
    
    const phoneNumberInput = document.getElementById('phoneNumber');
    
    const subButton = document.getElementById('subbtn');

    function checkPasswordMatch() {
        if (passwordInput.value !== confirmPasswordInput.value) {
            passwordMatchMessage.style.display = 'block';
        } else {
            passwordMatchMessage.style.display = 'none';
        }
    }

    

    passwordInput.addEventListener('input', function() {
        checkPasswordMatch();
    });

    confirmPasswordInput.addEventListener('input', function() {
        checkPasswordMatch();
    });

   

    
});
</script>

</body>
</html>
