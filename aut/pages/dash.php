<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // User is not logged in, redirect to login page
    header("Location: ../pages/index.php");
    exit();
}

// Check if last activity time is set
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > 1800) {
    // Last activity time has exceeded the session timeout (1800 seconds = 30 minutes)
    // Clear session variables and destroy session
    $_SESSION = array();
    session_destroy();
    
    // Redirect to login page with logout message
    header("Location: ../pages/index.php?logout=true");
    exit();
}

// Update last activity time
$_SESSION['last_activity'] = time();
?>

<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/6.6.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/6.6.1/firebase-database.js"></script>

<link rel="stylesheet" href="css/normalize.css">

    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.3/jquery.mCustomScrollbar.min.css'>

        <link rel="stylesheet" href="css/style.css">

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#config-web-app -->

<script>
  // Your web app's Firebase configuration
  var firebaseConfig = {
    apiKey: "AIzaSyByspokxPQ4Mk-HablOnJvLk5QfXKi-lTU",
    authDomain: "chat-app-a6a89.firebaseapp.com",
    databaseURL: "https://chat-app-a6a89-default-rtdb.firebaseio.com",
    projectId: "chat-app-a6a89",
    storageBucket: "chat-app-a6a89.appspot.com",
    messagingSenderId: "338532212923",
    appId: "1:338532212923:web:d471c4631362e9de2f499e",
    measurementId: "G-5MF6GZ6XX6"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);

  firebase.database().ref("messages").on("child_removed", function (snapshot) {
    document.getElementById("message-" + snapshot.key).innerHTML = "This message has been deleted";
  });

  function deleteMessage(self) {
    var messageId = self.getAttribute("data-id");
    firebase.database().ref("messages").child(messageId).remove();
  }

  function sendMessage() {
    var message = document.getElementById("message").value;
    firebase.database().ref("messages").push().set({
      "message": message,
      "sender": myName
    });
    return false;
  }


  // Set timeout duration in milliseconds (1 minute)
        const timeoutDuration = 60000;

        // Function to logout user
        function logout() {
            alert("Your session has expired. You will be logged out.");
            window.location.href = "../includes/logout.inc.php";
        }

        // Reset timeout function
        let timeout;

        // Function to reset timeout
        function resetTimeout() {
            clearTimeout(timeout);
            timeout = setTimeout(logout, timeoutDuration);
        }

        // Initialize timeout on page load
        resetTimeout();

        // Event listeners to reset timeout on user activity
        document.addEventListener("mousemove", resetTimeout);
        document.addEventListener("keydown", resetTimeout);
</script>

<style>
  figure.avatar {
    bottom: 0px !important;
  }
  .btn-delete {
    background: red;
    color: white;
    border: none;
    margin-left: 10px;
    border-radius: 5px;
  }
</style>

<div class="chat">
  <div class="chat-title">
    <h1>Chat Room</h1>
    <h2>Firebase</h2>
    <figure class="avatar">
      <img src="https://p7.hiclipart.com/preview/349/273/275/livechat-online-chat-computer-icons-chat-room-web-chat-others.jpg" /></figure>
  </div>
  <div class="messages">
    <div class="messages-content"></div>
  </div>
  <div class="message-box">
    <textarea type="text" class="message-input" id="message" placeholder="Type message..."></textarea>
    <button type="submit" class="message-submit">Send</button>
  </div>

</div>
<div class="bg"></div>

<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.3/jquery.mCustomScrollbar.concat.min.js'></script>

        <!--<script src="js/index.js?v=<?= time(); ?>?username=<?= $_SESSION['username']; ?>"></script>-->
        <script src="js/index.js?v=<?= time(); ?>"></script>


<style>
    .fixed-bottom {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        background-color: lightseagreen;
        color: white;
        text-align: center;
        padding: 25px;
        font-size: 20px;
    }
    
</style>
