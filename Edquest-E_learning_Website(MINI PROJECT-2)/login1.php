<?php
// Connect to database using PDO
include 'config.php';

// Check if form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $identifier = $_POST['identifier']; // This can be either email or mobile number
    $password = $_POST['password'];

    // Prepare query to retrieve user data based on email or contact number
    $sql = "SELECT * FROM users WHERE email = :email OR contact = :contact";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $identifier, 'contact' => $identifier]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Login successful
        session_start();
        $_SESSION['user'] = $user;
        $_SESSION['user_id'] = $user['id'];

        // Redirect to profile.html with user ID as a query string parameter
        header("Location: profile1.php?user_id=". $user['id']);
        exit();
    } else {
        // Login failed, redirect back to login page with error message
        header("Location: login.html?error=password");
        exit();
    }
}
?>