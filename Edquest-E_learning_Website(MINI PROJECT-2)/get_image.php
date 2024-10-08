<?php
include('connection.php');

// Retrieve user ID from query parameter
$user = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($user > 0) {
    // Fetch the user's profile image path
    $query = "SELECT profile_image_path FROM users WHERE id=?";
    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $user);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $profile_image_path);
        mysqli_stmt_fetch($stmt);
        
        if ($profile_image_path) {
            // Set the content type and output the image file
            $image_path = "../images/$user/$profile_image_path";
            if (file_exists($image_path)) {
                $mime_type = mime_content_type($image_path); // Detect MIME type
                header("Content-Type: $mime_type");
                readfile($image_path);
            } else {
                // Fallback image if file does not exist
                header("Content-Type: image/jpeg");
                readfile('../images/person.jpg');
            }
        } else {
            // Fallback image if no image path found
            header("Content-Type: image/jpeg");
            readfile('../images/person.jpg');
        }
        
        mysqli_stmt_close($stmt);
    } else {
        // Fallback image if query preparation fails
        header("Content-Type: image/jpeg");
        readfile('../images/person.jpg');
    }
} else {
    // Fallback image if invalid user ID
    header("Content-Type: image/jpeg");
    readfile('../images/person.jpg');
}

mysqli_close($conn);
?>
