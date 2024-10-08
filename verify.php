<?php
session_start(); // Start session

// Check if form is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve verification code entered by user
    $user_verification_code = $_POST['verification_code'];

    // Check if verification code is set in session
    if (isset($_SESSION['verification_code'])) {
        $verification_code = $_SESSION['verification_code'];

        // Validate verification code
        if ($user_verification_code == $verification_code) {
            // Verification successful
            // Perform further actions like activating user account in database, etc.

            // Clear verification code from session
            unset($_SESSION['verification_code']);

            // Redirect user to login page
            header("Location: http://localhost:81/verify/Edquest-E_learning_Website(MINI%20PROJECT-2)/login.html");
            exit;
        } else {
            // Verification failed
            $error = 'Invalid verification code. Please try again.';
        }
    } else {
        // No verification code in session
        $error = 'Verification code not found in session.';
    }
} else {
    // Handle GET requests or direct access to this file (if needed)
    $error = 'Method not allowed.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email</title>
    <link rel="stylesheet" href="loginStyle1.css">
</head>
<body>
    <div class="form-box">
        <h2>Verify Your Email</h2>
        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <form class="input-group" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="inp">
                <input type="text" name="verification_code" class="input-field" placeholder="Enter Verification Code" required>
            </div>
            <button type="submit" class="submit-btn">Verify</button>
        </form>
    </div>
</body>
</html>
