<?php
include "../config.php";

session_start();

if (isset($_SESSION['sec-username'])) {
    $uname = $_SESSION['sec-username'];
    $suser = mysqli_query($connect, "SELECT * FROM `users` WHERE username='$uname'");
    $count = mysqli_num_rows($suser);
    if ($count > 0) {
        echo '<meta http-equiv="refresh" content="0; url=dashboard.php" />';
        exit;
    }
}

$_GET  = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>phpBlog - Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
    <meta name="author" content="Antonov_WEB" />

    <link rel="shortcut icon" href="../assets/img/favicon.png" />

    <!-- Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" id="main-theme-script" />
    <link href="assets/css/styles.css" rel="stylesheet" />
	
	<!-- Font Awesome -->
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>

</head>

<body>

<div class="container">
  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="page-header">
            <center><h1>phpBlog</h1></center>
        </div>
      <div class="box">
        <h4 class="box-header round-top">Admin Panel</h4>
		<div class="box-container-toggle">
          <div class="box-content">
            <center><form class="well" action="" method="post" />
              <input type="text" name="username" class="form-control" placeholder="Username" required /><br />
              <input type="password" name="password" class="form-control" placeholder="Password" required /><br />
              <input type="submit" name="signin" value="Sign In" class="btn btn-primary" /><br /><br />
            </form></center>
<?php
if (isset($_POST['signin'])) {
    $username = mysqli_real_escape_string($connect, $_POST['username']);
    $password = hash('sha256', $_POST['password']);
    $check    = mysqli_query($connect, "SELECT username, password FROM `users` WHERE `username`='$username' AND password='$password'");
    if (mysqli_num_rows($check) > 0) {
        $_SESSION['sec-username'] = $username;
        echo '<meta http-equiv="refresh" content="0;url=dashboard.php">';
    } else {
        echo '<br />
		<div class="alert alert-danger">
              <i class="fa fa-exclamation-circle"></i> The entered <strong>Username</strong> or <strong>Password</strong> is incorrect.
        </div>';
    }
}
?> 
          </div>

      </div>

    </div>
  </div>
  <div class="col-md-3"></div>

</div>
</div>

<!-- jQuery --> 
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<!-- Bootstrap --> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>  

<!-- Main Scripts --> 
<script src="assets/js/main.js"></script>
</body>
</html>