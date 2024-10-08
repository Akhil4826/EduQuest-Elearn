<?php
session_start(); // Start session

// Include necessary files and configuration
include 'config.php'; // Ensure this file includes your database connection and any required functions
include 'C:\xampp\htdocs\verify\mail.php'; // Include your mailing function (if separate)

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve identifier (email or mobile number)
    $identifier = $_POST['identifier'];

    // Check if identifier exists in the database (assuming you have a users table)
    $sql = "SELECT * FROM users WHERE email = :identifier OR contact = :identifier";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['identifier' => $identifier]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // User found, generate verification code
        $verification_code = generateVerificationCode();

        // Save verification code and email in session
        $_SESSION['verification_code'] = $verification_code;
        $_SESSION['email'] = $user['email']; // Store email for verification page

        // Send verification email
        $subject = "Password Reset Verification Code";
        $message = "Hello,\n\n";
        $message .= "Your verification code is: $verification_code\n\n";
        $message .= "Please enter this code on the verification page to proceed with resetting your password.\n\n";
        $message .= "Best regards,\nYour Website Team";

        // Assuming send_mail() function is defined in mail.php
        if (send_mail($user['email'], $subject, $message)) {
            echo 'Verification email sent successfully.';
        } else {
            echo 'Error sending verification email.';
        }

        // Send verification SMS using cURL (assuming you have this functionality)
        // Code for sending SMS goes here

        // Redirect to verification page
        header("Location: http://localhost:81/verify/Edquest-E_learning_Website(MINI%20PROJECT-2)/verr.php");
        exit();
    } else {
        // User not found
        $error = 'User not found. Please check your email or mobile number.';
        header("Location: forgot_password.html?error=" . urlencode($error));
        exit();
    }
}

function generateVerificationCode() {
    // Generate a 6-digit random verification code
    return mt_rand(100000, 999999);
}
?>
