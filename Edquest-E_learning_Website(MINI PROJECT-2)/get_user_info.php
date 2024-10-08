<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Accept, Origin, X-Requested-With');

include 'db.php'; // Include database connection script

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // Prepare and execute the query to fetch user data
    $stmt = $conn->prepare('SELECT * FROM users WHERE id =?');
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the user data as an associative array
        $user = $result->fetch_assoc();
        echo json_encode($user);
    } else {
        echo json_encode(null);
    }
} else {
    echo json_encode(null);
}
