<?php
header('Content-Type: application/json');
include('connection.php');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Accept, Origin, X-Requested-With");


$user_id = $_GET['user_id'] ?? null;
$response = [];

if ($user_id) {
    $stmt = $conn->prepare("SELECT fullname, interests, location, email, age, course_name, start_date, duration, contact, profile_image_path FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $response = $result->fetch_assoc();
    }
    
    $stmt->close();
}

echo json_encode($response);
?>
