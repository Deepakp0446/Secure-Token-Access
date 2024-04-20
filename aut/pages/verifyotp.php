<?php
session_start();

// Include database configuration
include_once '../includes/db.php';

// Check if the OTP parameter is set in the URL
if (isset($_GET['otp'])) {
    // Retrieve OTP from the URL
    $otp = $_GET['otp'];

    // Check if OTP is set and not empty
    if (!empty($otp)) {
        // Retrieve phone number from session
        $phoneNumber = $_SESSION['phoneNumber'];

        // Initialize cURL session
        $curl = curl_init();

        // Set the URL for OTP verification
        $url = 'https://2factor.in/API/V1/e60bd9c1-ee9c-11ee-8cbb-0200cd936042/SMS/VERIFY3/'.$phoneNumber.'/'.$otp;

        // Set cURL options
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        // Execute cURL request and store the response
        $response = curl_exec($curl);

        // Close cURL session
        curl_close($curl);

        // Decode JSON response
        $responseData = json_decode($response, true);

        // Check if OTP verification was successful
        if ($responseData['Status'] === 'Success') {
            // Update user data in the database
            $update_sql = "UPDATE users SET verified = 1 WHERE phone_no = '$phoneNumber'";
            if ($conn->query($update_sql) === TRUE) {
                // Display JavaScript alert after OTP verification and database update
                echo '<script>alert("OTP verification successful! Redirecting to Login page."); window.location.href = "index.php";</script>';
                exit; // Stop further execution of the script
            } else {
                // If database update fails, display error message
                echo "Error updating record: " . $conn->error;
            }
        } else {
            // If OTP verification failed, display error message
            $errorMessage = $responseData['Details'];
            echo '<script>alert("Invalid OTP!."); window.location.href = "otp.php";</script>';
        }
    } else {
        // If OTP is empty, display error message
        echo "OTP is empty!";
    }
} else {
    // If OTP parameter is not set in the URL, display error message
    echo "OTP parameter not found in URL!";
}
?>