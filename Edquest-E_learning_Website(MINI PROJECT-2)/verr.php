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
            // Store identifier (email) in session for password reset
            if (isset($_SESSION['email'])) {
                $_SESSION['identifier'] = $_SESSION['email']; // Store email in identifier session variable
                unset($_SESSION['verification_code']); // Clear verification code from session
                header("Location: http://localhost:81/verify/Edquest-E_learning_Website(MINI%20PROJECT-2)/reset_password.php");
                exit;
            } else {
                $error = 'Email not found in session. Please initiate the password reset process again.';
            }
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
    $error = 'Enter the verification code';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email</title>
    <link rel="stylesheet" href="loginStyle1.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-box {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        .form-box h2 {
            margin-bottom: 20px;
        }
        .input-group {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .input-field {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .submit-btn {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }
        .submit-btn:hover {
            background-color: #0056b3;
        }
        .error {
            color: red;
            margin-bottom: 15px;
        }
    </style>
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
