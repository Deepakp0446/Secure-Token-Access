<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/style.css">
    <style type="text/css">
      select {
        width: 95%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }
    </style>
</head>
<body>
<div class="background-panel">
  <div class="login-container">
        <h2>Login</h2>
        <!-- Display error message if it exists -->
    <?php if (isset($_SESSION['error'])): ?>
        <div style="color: red;"><?php echo $_SESSION['error']; ?></div>
        <?php unset($_SESSION['error']); // Clear the error message from the session ?>
    <?php endif; ?>
        <form action="../includes/login.inc.php" method="post">
            <input type="text" name="username" placeholder="Username" autocomplete="off" required>
            <input type="password" name="password" placeholder="Password" autocomplete="off" required>
            
            <button type="submit" name="login-submit">Login</button>
        </form>
        <a href="register.php">Create an account</a>
    </div>
    </div>
</body>
</html>
