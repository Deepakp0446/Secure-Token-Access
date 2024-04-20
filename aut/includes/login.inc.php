<?php
session_start();
function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if (isset($_POST['login-submit'])) {
    include_once 'db.php';

    $username = sanitize_input($_POST['username']);
    $password = sanitize_input($_POST['password']);
    
    $_SESSION['username'] = $username;

    // Prepare and execute SQL statement to retrieve user from database
    $sql = "SELECT * FROM users WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // User exists, verify password
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Password is correct, generate token and store in database
            $token = bin2hex(random_bytes(32)); // Generate random token
            $expires_at = date('Y-m-d H:i:s', strtotime('+1 day')); // Token expires in 1 day
            $sql = "INSERT INTO tokens (user_id, token, expires_at) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iss", $user['id'], $token, $expires_at);
            if ($stmt->execute()) {
                // Token stored successfully, redirect to appropriate dashboard
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['token'] = $token;
                header("Location: ../pages/dash.php"); // Redirect to dashboard page
                exit();
            } else {
                // Error storing token
                $_SESSION['error'] = "Error storing token";
                header("Location: ../pages/index.php");
                exit();
            }
        } else {
            // Incorrect password
            $_SESSION['error'] = "Incorrect password";
            header("Location: ../pages/index.php?error=Incorrect password");
            exit();
        }
    } else {
        // User does not exist
        $_SESSION['error'] = "User does not exist or invalid role";
        header("Location: ../pages/index.php?error=User does not exist or invalid role");
        exit();
    }
} else {
    // Redirect to login page if login form is not submitted
    header("Location: ../pages/index.php");
    exit();
}
?>
