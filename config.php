<?php
$host = "localhost";   // usually localhost
$user = "root";        // default XAMPP username
$pass = "";            // default XAMPP password is empty
$db   = "phantom_pixel";  // your database name

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}