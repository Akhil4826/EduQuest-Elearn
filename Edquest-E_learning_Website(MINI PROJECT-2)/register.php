<?php
session_start(); // Start session

include 'config.php';
include 'C:\xampp\htdocs\verify\mail.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $fullname = $_POST['fullname'];
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $location = $_POST['location'];
    $age = $_POST['age'];
    $interests = $_POST['interests'];
    $course_name = $_POST['course_name'];
    $start_date = $_POST['start_date'];
    $duration = $_POST['duration'];
    $contact = $_POST['contact'];

    // Generate a verification code
    $verification_code = generateVerificationCode();

    // Save the verification code in session
    $_SESSION['verification_code'] = $verification_code;

    // Save the user information and verification code in your database
    $sql = "INSERT INTO users (fullname, email, password, location, age, interests, course_name, start_date, duration, contact, verification_code) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$fullname, $email, $password, $location, $age, $interests, $course_name, $start_date, $duration, $contact, $verification_code]);

    // Send verification email
    $subject = "Verify your email address";
    $message = "Hello $fullname,\n\n";
    $message .= "Thank you for registering with us.\n";
    $message .= "Your verification code is: $verification_code\n\n";
    $message .= "Enter this code on the verification page to activate your account.\n\n";
    $message .= "Best regards,\nYour Website Team";

    // Send email
    if (send_mail($email, $subject, $message)) {
        echo 'Verification email sent successfully.';
    } else {
        echo 'Error sending verification email.';
    }

    // Send verification SMS using cURL
    $account_sid = 'Enter Your own Account SID'; 
    $auth_token = 'Enter your own Auth Token'; 
    $twilio_number = 'Enter your own Twilio Number';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.twilio.com/2010-04-01/Accounts/' . $account_sid . '/Messages.json');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERPWD, $account_sid . ':' . $auth_token);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
        'To' => $contact,
        'From' => $twilio_number,
        'Body' => "Your verification code is: $verification_code"
    ]));

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if ($http_code != 201) {
        echo 'Error sending verification SMS: ' . $response;
    } else {
        echo 'Verification SMS sent successfully.';
    }

    curl_close($ch);

    // Redirect to verification page after successful registration
    header('Location: http://localhost:81/verify/verify.php');
    exit();
}

function generateVerificationCode() {
    // Generate a 6-digit random verification code
    return mt_rand(100000, 999999);
}
