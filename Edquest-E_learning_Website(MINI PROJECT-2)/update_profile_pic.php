<?php 
//session_start();
include('connection.php');

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    die("User not logged in.");
}

// Set the user ID from session
$user_id = $_SESSION['user_id'];

if(isset($_POST['update'])) {
    $img = $_FILES['f']['name'];

    // Update image in database
    $query = "UPDATE users SET profile_image_path=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "si", $img, $user_id); // Corrected parameter binding
    mysqli_stmt_execute($stmt);

    // Move uploaded file to directory
    $targetDir = "../images/$user_id/";
    if(!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true); // Create directory if it doesn't exist
    }
    move_uploaded_file($_FILES['f']['tmp_name'], $targetDir . $_FILES['f']['name']);

    $err = "<font color='blue'>Profile Pic updated successfully!</font>";
}

// Select old data
$sql = mysqli_query($conn, "SELECT * FROM users WHERE id='$user_id'");
$res = mysqli_fetch_assoc($sql);
?>

<h2 align="center">Update Your Image</h2>
<form method="post" enctype="multipart/form-data">
    <table class="table table-bordered">
        <tr>
            <td colspan="2"><?php echo @$err;?></td>
        </tr>
        <tr>
            <td>Choose Your pic</td>
            <td><input class="form-control" type="file" name="f"/></td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <input type="submit" class="btn btn-default" value="Update My Profile Pic" name="update"/>
            </td>
        </tr>
    </table>
</form>
