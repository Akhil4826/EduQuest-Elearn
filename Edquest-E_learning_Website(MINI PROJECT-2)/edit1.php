<?php
session_start();
include('connection.php');

// Ensure user_id is present in the session and URL
if (!isset($_SESSION['user_id'])) {
    die("User not logged in.");
}

$user_id = $_SESSION['user_id'];

// Ensure the user_id from the URL matches the session user_id
if (isset($_GET['user_id']) && $_GET['user_id'] != $user_id) {
    die("Unauthorized access.");
}

// Validate the field parameter
$valid_fields = ['fullname', 'email', 'location', 'age', 'interests', 'course_name', 'start_date', 'duration', 'verification_code', 'contact'];
$field = isset($_GET['field']) ? $_GET['field'] : '';

if (!in_array($field, $valid_fields)) {
    die("Invalid field specified.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate the new value
    $new_value = mysqli_real_escape_string($conn, $_POST['value']);
    
    // Update the user's field in the database
    $sql = "UPDATE users SET $field='$new_value' WHERE id='$user_id'";
    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit();
    } else {
        die("Error updating record: " . mysqli_error($conn));
    }
}

// Fetch the current value of the field
$sql = "SELECT $field FROM users WHERE id='$user_id'";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Database query failed: " . mysqli_error($conn));
}
$user_data = mysqli_fetch_assoc($result);

if (!$user_data) {
    die("No user data found.");
}

$current_value = $user_data[$field];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit <?php echo htmlspecialchars($field); ?></title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1>Edit <?php echo htmlspecialchars($field); ?></h1>
    <form method="post" action="">
        <div class="form-group">
            <label for="value">New Value</label>
            <input type="text" class="form-control" id="value" name="value" value="<?php echo htmlspecialchars($current_value); ?>">
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>
