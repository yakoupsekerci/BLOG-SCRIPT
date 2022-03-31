<?php
$host     = "localhost"; // Database Host
$user     = "root"; // Database Username
$password = ""; // Database's user Password
$database = "phpblog"; // Database Name

$connect = new mysqli($host, $user, $password, $database);

// Checking Connection
if (mysqli_connect_errno()) {
    printf("Database connection failed: %s\n", mysqli_connect_error());
    exit();
}

mysqli_set_charset($connect, "utf8");

$site_url       = "http://localhost/codecanyon/Source";
?>