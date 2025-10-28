<?php
//Start database connection
$host = "localhost";
$username = "root"; //administrative user
$password = ""; 
$database = "phantom_pixel"; // add in database later on

// Connection function
$conn = mysqli_connect("localhost", "root", "", "phantom_pixel");

// Check the connection to see if connection is uncessful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>