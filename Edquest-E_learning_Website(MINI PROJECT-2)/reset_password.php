<?php
session_start(); // Start session

// Database connection parameters (adjust as necessary)
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = "root@123"; // Your MySQL password
$dbname = "test1"; // Your MySQL database name

// Establishing MySQL connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve new password and confirm password
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate passwords
    if (empty($new_password) || empty($confirm_password)) {
        $error = "Please enter both new password and confirm password.";
    } elseif ($new_password !== $confirm_password) {
        $error = "Passwords do not match. Please try again.";
    } else {
        // Retrieve identifier from session (email or phone number)
        if (isset($_SESSION['identifier'])) {
            $identifier = $_SESSION['identifier'];

            // Hash the new password using password_hash() for secure hashing
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Update password in database using prepared statements for security
            $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
            $stmt->bind_param('ss', $hashed_password, $identifier);

            if ($stmt->execute()) {
                // Password updated successfully
                $success_message = "Password updated successfully.";
            } else {
                // Error updating password
                $error = "Error updating password: " . $stmt->error;
            }

            $stmt->close();
        } else {
            // Identifier not found in session
            $error = "Session expired. Please request password reset again.";
        }
    }

    if (isset($error)) {
        echo "<div class='error'>$error</div>";
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
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
            font-size: 24px;
            color: #333;
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
            font-size: 16px;
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
        .success {
            color: green;
            margin-bottom: 15px;
        }
        .login-link {
            margin-top: 10px;
            font-size: 14px;
        }
        .login-link a {
            color: #007bff;
            text-decoration: none;
        }
        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="form-box">
        <h2>Reset Your Password</h2>
        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if (isset($success_message)): ?>
            <div class="success"><?php echo $success_message; ?></div>
        <?php endif; ?>
        <?php if (isset($success_message)): ?>
            <div class="login-link">Go back to <a href="login.html">Login</a></div>
        <?php endif; ?>
        <form class="input-group" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="inp">
                <input type="password" name="new_password" class="input-field" placeholder="Enter New Password" required>
            </div>
            <div class="inp">
                <input type="password" name="confirm_password" class="input-field" placeholder="Confirm New Password" required>
            </div>
            <button type="submit" class="submit-btn">Reset Password</button>
        </form>
    </div>
</body>
</html>
