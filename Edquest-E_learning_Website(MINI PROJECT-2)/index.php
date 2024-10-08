<?php
session_start();
include('connection.php');

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    die("User not logged in.");
}

// Set the user ID from session
$user_id = $_SESSION['user_id'];

// Fetch user data
$sql = "SELECT * FROM users WHERE id='$user_id'";
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if (!$result) {
    die("Database query failed: " . mysqli_error($conn));
}

// Fetch user data into an associative array
$users = mysqli_fetch_assoc($result);

// Check if user data was found
if (!$users) {
    die("No user data found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>User Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/dashboard.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</head>

<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Hello <?php echo htmlspecialchars($users['fullname']); ?></a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid">
  <div class="row">
    <div class="col-sm-3 col-md-2 sidebar">
    
<ul class="nav nav-sidebar">
    <li class="active"><a href="index.php">Dashboard <span class="sr-only">(current)</span></a></li>
    <li><a href="index.php?page=update_profile_pic"><img title="Update Your profile pic Click here" style="border-radius:50px" src="http://localhost:81/verify/Edquest-E_learning_Website(MINI%20PROJECT-2)/get_image.php?id=<?php echo $user_id; ?>" width="100" height="100" alt="Profile Picture"/></a></li>
</ul>

    <!-- Homepage Link with Logo -->
    <li>
        <a href="index.html">
            Home
        </a>
    </li>

    <!-- Update Password Link -->
    <li>
        <a href="http://localhost:81/verify/Edquest-E_learning_Website(MINI%20PROJECT-2)/forgot_password.html">
      Update Password
        </a>
    </li>

    <!-- Edit Profile Link -->
    <li>
        <a href="http://localhost:81/verify/Edquest-E_learning_Website(MINI%20PROJECT-2)/update.html?user_id=<?php echo urlencode($user_id); ?>" class="profile-link">
            Edit Profile
        </a>
    </li>
</ul>

    </div>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
      <?php 
      $page = $_GET['page'] ?? '';
      if ($page) {
        switch ($page) {
          case 'update_password':
            include('update_password.php');
            break;
          case 'notification':
            include('notification.php');
            break;
          case 'update_profile':
            include('update_profile.php');
            break;
          case 'update_profile_pic':
            include('update_profile_pic.php');
            break;
          default:
            include('notification.php');
            break;
        }
      } else {
        ?>
        <h1 class="page-header">Dashboard</h1>
        <div class="panel panel-default">
          <div class="panel-heading">User Profile Information</div>
          <div class="panel-body">
            <table class="table table-bordered">
              <tr>
                <th>Full Name</th>
                <td><?php echo htmlspecialchars($users['fullname']); ?></td>
                <td><a href="edit1.php?field=fullname&user_id=<?php echo urlencode($user_id); ?>">Edit</a></td>
              </tr>
              <tr>
                <th>Email</th>
                <td><?php echo htmlspecialchars($users['email']); ?></td>
                <td><a href="edit1.php?field=email&user_id=<?php echo urlencode($user_id); ?>">Edit</a></td>
              </tr>
              <tr>
                <th>Location</th>
                <td><?php echo htmlspecialchars($users['location']); ?></td>
                <td><a href="edit1.php?field=location&user_id=<?php echo urlencode($user_id); ?>">Edit</a></td>
              </tr>
              <tr>
                <th>Age</th>
                <td><?php echo htmlspecialchars($users['age']); ?></td>
                <td><a href="edit1.php?field=age&user_id=<?php echo urlencode($user_id); ?>">Edit</a></td>
              </tr>
              <tr>
                <th>Interests</th>
                <td><?php echo htmlspecialchars($users['interests']); ?></td>
                <td><a href="edit1.php?field=interests&user_id=<?php echo urlencode($user_id); ?>">Edit</a></td>
              </tr>
              <tr>
                <th>Course Name</th>
                <td><?php echo htmlspecialchars($users['course_name']); ?></td>
                <td><a href="edit1.php?field=course_name&user_id=<?php echo urlencode($user_id); ?>">Edit</a></td>
              </tr>
              <tr>
                <th>Start Date</th>
                <td><?php echo htmlspecialchars($users['start_date']); ?></td>
                <td><a href="edit1.php?field=start_date&user_id=<?php echo urlencode($user_id); ?>">Edit</a></td>
              </tr>
              <tr>
                <th>Duration</th>
                <td><?php echo htmlspecialchars($users['duration']); ?></td>
                <td><a href="edit1.php?field=duration&user_id=<?php echo urlencode($user_id); ?>">Edit</a></td>
              </tr>
           
              <tr>
                <th>Contact</th>
                <td><?php echo htmlspecialchars($users['contact']); ?></td>
                <td><a href="edit1.php?field=contact&user_id=<?php echo urlencode($user_id); ?>">Edit</a></td>
              </tr>
            </table>
          </div>
        </div>
        <?php
      }
      ?>
    </div>
  </div>
</div>

<!-- Bootstrap core JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>
