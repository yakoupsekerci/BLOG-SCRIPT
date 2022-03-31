<?php
include '../config.php';

session_start();

if (isset($_SESSION['sec-username'])) {
    $uname = $_SESSION['sec-username'];
    $suser = mysqli_query($connect, "SELECT * FROM `users` WHERE username='$uname'");
    $count = mysqli_num_rows($suser);
    if ($count < 0) {
        echo '<meta http-equiv="refresh" content="0; url=index.php" />';
        exit;
    }
} else {
    echo '<meta http-equiv="refresh" content="0; url=index.php" />';
    exit;
}

if (basename($_SERVER['SCRIPT_NAME']) != 'add_post.php' && basename($_SERVER['SCRIPT_NAME']) != 'posts.php' && basename($_SERVER['SCRIPT_NAME']) != 'add_page.php' && basename($_SERVER['SCRIPT_NAME']) != 'pages.php' && basename($_SERVER['SCRIPT_NAME']) != 'add_widget.php' && basename($_SERVER['SCRIPT_NAME']) != 'widgets.php' && basename($_SERVER['SCRIPT_NAME']) != 'add_ad.php' && basename($_SERVER['SCRIPT_NAME']) != 'ads.php') {
    $_GET  = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
}

function short_text($text, $length)
{
    $maxTextLenght = $length;
    $aspace        = " ";
    if (strlen($text) > $maxTextLenght) {
        $text = substr(trim($text), 0, $maxTextLenght);
        $text = substr($text, 0, strlen($text) - strpos(strrev($text), $aspace));
        $text = $text . '...';
    }
    return $text;
}

function byte_convert($size)
{
    if ($size < 1024)
        return $size . ' Byte';
    if ($size < 1048576)
        return sprintf("%4.2f KB", $size / 1024);
    if ($size < 1073741824)
        return sprintf("%4.2f MB", $size / 1048576);
    if ($size < 1099511627776)
        return sprintf("%4.2f GB", $size / 1073741824);
    else
        return sprintf("%4.2f TB", $size / 1073741824);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
    <title>phpBlog - Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
    <meta name="author" content="Antonov_WEB" />

    <link rel="shortcut icon" href="../assets/img/favicon.png" />

    <!-- Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="assets/css/styles.css" rel="stylesheet" />

	<!-- Font Awesome -->
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
	
	<!--DataTables-->
    <link href="assets/plugins/datatables/datatables.min.css" rel="stylesheet">
	
	<!-- jQuery --> 
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	
	<!-- CK Editor -->
	<script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>
	
<body>

<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
	<div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
         <span class="sr-only">Toggle navigation</span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
      </button>
	  <a class="navbar-brand" href="dashboard.php">phpBlog - Admin Panel</a>
	  </div>
	  <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
			<li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> <?php
echo $uname;
?> <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
                </ul>
              </li>
		   </ul>
      </div>
    </div>
</nav>

<div class="container">
  <div class="row">

    <div class="col-md-3">        
      <div class="sidebar-nav">
      	<div class="well" style="padding: 8px 0;">
        <ul class="nav nav-list"> 
          <li class="nav-header">Main</li>
          <li <?php
if (basename($_SERVER['SCRIPT_NAME']) == 'dashboard.php') {
    echo 'class="active"';
}
?>><a href="dashboard.php"><i class="fa fa-home"></i> Dashboard</a></li>
		  <li <?php
if (basename($_SERVER['SCRIPT_NAME']) == 'settings.php') {
    echo 'class="active"';
}
?>><a href="settings.php"><i class="fa fa-cogs"></i> Settings</a></li>
		  <li <?php
if (basename($_SERVER['SCRIPT_NAME']) == 'messages.php') {
    echo 'class="active"';
}
?>><a href="messages.php"><i class="fa fa-envelope"></i> Messages</a></li>
		  <li <?php
if (basename($_SERVER['SCRIPT_NAME']) == 'users.php') {
    echo 'class="active"';
}
?>><a href="users.php"><i class="fa fa-users"></i> Users</a></li>
		  <li <?php
if (basename($_SERVER['SCRIPT_NAME']) == 'menu_editor.php') {
    echo 'class="active"';
}
?>><a href="menu_editor.php"><i class="fa fa-bars"></i> Menu Editor</a></li>
		  <li class="nav-header">Posts</li>
          <li <?php
if (basename($_SERVER['SCRIPT_NAME']) == 'add_post.php') {
    echo 'class="active"';
}
?>><a href="add_post.php"><i class="fa fa-edit"></i> Add Post</a></li>
		  <li <?php
if (basename($_SERVER['SCRIPT_NAME']) == 'posts.php') {
    echo 'class="active"';
}
?>><a href="posts.php"><i class="fa fa-list"></i> Posts</a></li>
		  <li <?php
if (basename($_SERVER['SCRIPT_NAME']) == 'categories.php') {
    echo 'class="active"';
}
?>><a href="categories.php"><i class="fa fa-list-ol"></i> Categories</a></li>
          <li <?php
if (basename($_SERVER['SCRIPT_NAME']) == 'comments.php') {
    echo 'class="active"';
}
?>><a href="comments.php"><i class="fa fa-comments-o"></i> Comments</a></li>
		  <li class="nav-header">Gallery</li>
          <li <?php
if (basename($_SERVER['SCRIPT_NAME']) == 'add_image.php') {
    echo 'class="active"';
}
?>><a href="add_image.php"><i class="fa fa-edit"></i> Add Image</a></li>
		  <li <?php
if (basename($_SERVER['SCRIPT_NAME']) == 'gallery.php') {
    echo 'class="active"';
}
?>><a href="gallery.php"><i class="fa fa-picture-o"></i> Gallery</a></li>
		  <li class="nav-header">Pages</li>
          <li <?php
if (basename($_SERVER['SCRIPT_NAME']) == 'add_page.php') {
    echo 'class="active"';
}
?>><a href="add_page.php"><i class="fa fa-edit"></i> Add Page</a></li>
		  <li <?php
if (basename($_SERVER['SCRIPT_NAME']) == 'pages.php') {
    echo 'class="active"';
}
?>><a href="pages.php"><i class="fa fa-file-text-o"></i> Pages</a></li>
		  <li class="nav-header">Widgets</li>
          <li <?php
if (basename($_SERVER['SCRIPT_NAME']) == 'add_widget.php') {
    echo 'class="active"';
}
?>><a href="add_widget.php"><i class="fa fa-edit"></i> Add Widget</a></li>
		  <li <?php
if (basename($_SERVER['SCRIPT_NAME']) == 'widgets.php') {
    echo 'class="active"';
}
?>><a href="widgets.php"><i class="fa fa-archive"></i> Widgets</a></li>
		  <li class="nav-header">Other</li>
          <li <?php
if (basename($_SERVER['SCRIPT_NAME']) == 'files.php') {
    echo 'class="active"';
}
?>><a href="files.php"><i class="fa fa-files-o"></i> Files</a></li>
		  <li <?php
if (basename($_SERVER['SCRIPT_NAME']) == 'ads.php') {
    echo 'class="active"';
}
?>><a href="ads.php"><i class="fa fa-bullhorn"></i> Ads</a></li>
        </ul>
        </div>
      </div>
    </div>