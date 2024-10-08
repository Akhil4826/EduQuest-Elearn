<?php
header('Content-Type: image/jpeg'); // Change content-type based on your image type
header("Access-Control-Allow-Origin: *");

include('connection.php');

$user_id = $_GET['user_id'] ?? null;

if ($user_id) {
    $stmt = $conn->prepare("SELECT profile_image, profile_image_path FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($profile_image, $profile_image_path);
    $stmt->fetch();

    if ($profile_image) {
        echo $profile_image;
    } elseif ($profile_image_path) {
        // If image data is not available, you can fallback to file path if needed
        header('Location: ' . $profile_image_path);
    } else {
        // Placeholder image or handle error
        header('Location: /path/to/placeholder-image.jpg');
    }

    $stmt->close();
}
?>
