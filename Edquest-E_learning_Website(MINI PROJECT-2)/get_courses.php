<?php
// Connect to the database
$conn = mysqli_connect("localhost", "root", "root@123", "test1");

// Check connection
if (!$conn) {
    die("Connection failed: ". mysqli_connect_error());
}

// Query to retrieve all courses
$sql = "SELECT * FROM courses";
$result = mysqli_query($conn, $sql);

// Check if query was successful
if (!$result) {
    die("Query failed: ". mysqli_error($conn));
}

// Create an array to store the courses
$courses = array();

// Loop through the results and add each course to the array
while ($row = mysqli_fetch_assoc($result)) {
    $courses[] = array(
        "id" => $row["id"],
        "name" => $row["name"],
        "description" => $row["description"],
        "duration" => $row["duration"],
        "tags" => explode(",", $row["tags"]) // assuming tags are stored as a comma-separated string
    );
}

// Close the database connection
mysqli_close($conn);

// Output the courses in JSON format
echo json_encode($courses);
?>