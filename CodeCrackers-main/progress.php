<?php
session_start();
include '../db/db.php'; // Update the path as necessary to include your database connection file

if (!isset($_SESSION['email'])) {
    echo json_encode(["error" => "User not logged in"]);
    exit;
}

$email = $_SESSION['email'];
$query = "SELECT * FROM users1 WHERE email = '$email'";
$result = mysqli_query($con, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    echo json_encode(["error" => "User data not found"]);
    exit;
}

$row = mysqli_fetch_assoc($result);

// Assuming your `users1` table has columns for the progress of each tutorial
$response = [
    "python" => isset($row['python_progress']) ? $row['python_progress'] : 0,
    "html" => isset($row['html_progress']) ? $row['html_progress'] : 0,
    "css" => isset($row['css_progress']) ? $row['css_progress'] : 0,
    "javascript" => isset($row['javascript_progress']) ? $row['javascript_progress'] : 0,
    "sql" => isset($row['sql_progress']) ? $row['sql_progress'] : 0,
    "php" => isset($row['php_progress']) ? $row['php_progress'] : 0
];

echo json_encode($response);
?>
