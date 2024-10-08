<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Accept, Origin, X-Requested-With');

include 'db.php'; // Ensure this includes your database connection file
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize input data
    $userId = intval($_POST['user_id']);
    $fullname = $conn->real_escape_string($_POST['fullname']);
    $email = $conn->real_escape_string($_POST['email']);
    $location = $conn->real_escape_string($_POST['location']);
    $age = intval($_POST['age']);
    $interests = $conn->real_escape_string($_POST['interests']);
    $course_name = $conn->real_escape_string($_POST['course_name']);
    $start_date = $conn->real_escape_string($_POST['start_date']);
    $duration = intval($_POST['duration']);

    // Prepare SQL query
    $sql = "UPDATE users SET fullname='$fullname', email='$email', location='$location', age=$age, interests='$interests', course_name='$course_name', start_date='$start_date', duration=$duration WHERE id=$userId";

    // Execute query and handle response
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success", "message" => "User info updated successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error updating record: " . $conn->error]);
    }

    $conn->close();
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
}
