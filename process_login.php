<?php

session_start();

require_once("settings.php"); // db connection settings

$conn = mysqli_connect($host, $username, $password, $database); // create connection

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // check if post was used for submitting form
    $input_username = trim($_POST['username']);
    $input_password = trim($_POST['password']);

    $query = "SELECT * FROM users WHERE username = '$input_username' AND password = '$input_password'"; // SQL query to check if the U and P match in db

    $result = mysqli_query($conn, $query);

    if ($user = mysqli_fetch_assoc($result)) {
        $_SESSION['username'] = $user['username']; //save username in the session

        if ($user['username'] === 'Admin') { // check if U if Admin and direct to manager.php if so
            header('Location: manager.php');
            exit;
        }

        else {
            header('Location: index.php');
            exit;
        }
    }

    else {
        $_SESSION['error'] = "Invalid username or password. Please try again."; // if login failed go back to login page
        header('Location: login.php');
        exit;
    }
}
?>