<?php
//Database connection
$host = "localhost";
$user = "root";
$pwd = " ";
$sql_db = " "; // add in database later on

// Connection function
$conn = mysqli_connect("localhost", "root", " ", " database name")

// Check the connection to see if it is functioning correctly
if (!conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>