<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Accept, Origin, X-Requested-With");

include('connection.php');

$user_id = $_POST['user_id'] ?? null;
$file = $_FILES['profile_image'] ?? null;
$response = ['error' => ''];

if ($user_id && $file) {
    $fileTmpPath = $file['tmp_name'];
    $fileName = basename($file['name']);
    $fileSize = $file['size'];
    $fileType = $file['type'];
    $fileData = file_get_contents($fileTmpPath);

    // Prepare SQL query to update the profile image in binary format
    $stmt = $conn->prepare("UPDATE users SET profile_image = ?, profile_image_path = ? WHERE id = ?");
    $stmt->bind_param("bsi", $fileData, $fileName, $user_id);
    
    // Check if the file is an image and other validations
    $check = getimagesize($fileTmpPath);
    if ($check === false) {
        $response['error'] = 'File is not an image.';
        $stmt->close();
    } elseif ($fileSize > 5000000) {
        $response['error'] = 'File is too large. Maximum size is 5MB.';
        $stmt->close();
    } elseif (!in_array($fileType, ['image/jpeg', 'image/png', 'image/gif'])) {
        $response['error'] = 'Only JPG, JPEG, PNG, & GIF files are allowed.';
        $stmt->close();
    } else {
        if ($stmt->execute()) {
            $response['profile_image_path'] = "path_to_image_directory/$fileName";
        } else {
            $response['error'] = 'Error updating profile picture.';
        }
        $stmt->close();
    }
}

echo json_encode($response);
?>
