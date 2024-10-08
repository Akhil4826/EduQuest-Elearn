<?php
// Replace with your database connection details
$servername = "localhost";
$username = "root";
$password = "root@123";
$dbname = "test1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch total students from the database
$sql_students = "SELECT COUNT(*) AS total_students FROM users";
$result_students = $conn->query($sql_students);

if ($result_students->num_rows > 0) {
    $row_students = $result_students->fetch_assoc();
    $total_students = $row_students["total_students"];
} else {
    $total_students = 'N/A';
}

// Example queries for other data (total_courses, placed_students, total_projects)
$total_courses = 21; // Replace with actual logic to fetch from database
$placed_students = 56; // Replace with actual logic to fetch from database
$total_projects = 27; // Replace with actual logic to fetch from database

// Prepare data to be sent as JSON
$data = array(
    'total_students' => $total_students,
    'total_courses' => $total_courses,
    'placed_students' => $placed_students,
    'total_projects' => $total_projects
);

// Output the data as JSON
header('Content-Type: application/json');
echo json_encode($data);

$conn->close();
?>
