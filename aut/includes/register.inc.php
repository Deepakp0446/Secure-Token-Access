<?php
// Include database configuration
include_once 'db.php';

// Function to sanitize input data
function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}



// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = sanitize_input($_POST["username"]);
    $password = sanitize_input($_POST["password"]);
    
    $phoneNumber = sanitize_input($_POST["phoneNumber"]);
    session_start();
    $_SESSION['phoneNumber']=$phoneNumber;

    // Check if the username already exists
    $check_username_sql = "SELECT * FROM users WHERE username = '$username'";
    $check_username_result = $conn->query($check_username_sql);

    if ($check_username_result->num_rows > 0) {
        // Username already exists, display popup
        echo '<script type="text/javascript">
                window.onload = function() {
                    document.getElementById("userExistPopup").style.display = "block";
                }
              </script>';
    } else {
        // Encrypt password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // SQL to insert data into database
        $insert_sql = "INSERT INTO users (username, password, phone_no) VALUES ('$username', '$hashedPassword',  '$phoneNumber')";

        if ($conn->query($insert_sql) === TRUE) {
            // Execute JavaScript function to show the success popup
            echo '<script type="text/javascript">
                    window.onload = function() {
                        document.getElementById("successPopup").style.display = "block";
                    }
                  </script>';
        } else {
            echo "Error: " . $insert_sql . "<br>" . $conn->error;
        }
    }
}

// Close database connection
$conn->close();






?>

<style>
    /* Popup styles */
.popup {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: rgba(0, 0, 0, 0.5);
    width: 300px;
    padding: 20px;
    border-radius: 5px;
    z-index: 9999;
}

.popup-content {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
}

.close {
    position: absolute;
    top: 5px;
    right: 10px;
    font-size: 40px;
    cursor: pointer;
}

</style>
<script>
    // Function to close the popup and redirect
    function closePopupAndRedirect(popupId, redirectUrl) {
        document.getElementById(popupId).style.display = 'none';
        window.location.href = redirectUrl;
    }
</script>
<!-- Popup for user already exists -->
<div id="userExistPopup" class="popup">
    <div class="popup-content">
        <span class="close" onclick="closePopupAndRedirect('userExistPopup', '../pages/register.php')">&times;</span>
        <p>User already exists! Please choose a different username.</p>
    </div>
</div>

<!-- Popup for successful registration -->
<div id="successPopup" class="popup">
    <div class="popup-content">
        <span class="close" onclick="closePopupAndRedirect('successPopup', '../pages/otp.php')">&times;</span>
        <p>Registration successful! Verify OTP and Continue</p>
    </div>
</div>


<script>
    // Function to close the popup
    function closePopupAndRedirect(popupId, redirectUrl) {
    document.getElementById(popupId).style.display = 'none';
    window.location.href = redirectUrl;
}

</script>
