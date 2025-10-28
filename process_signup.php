<?php

    session_start();
    require_once("settings.php");

    $conn = mysqli_connect($host, $username, $password, $database);

    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') { // check if post was used for submitting form
        $input_username = trim($_POST['username']);
        $input_password = trim($_POST['password']);
        $hash_password = password_hash($input_password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (username, password) VALUES ('$input_username', '$hash_password')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $_SESSION['flash'] = "Signup successful. You can now login."; // flash in order to show successful sign up feed back
            header("Location: login.php"); 
            exit;
        } 

        else {
            $_SESSION['error'] = "Signup failed. Please try again."; // if signup failed go back to signup page
            header('Location: signup.php');
            exit;
        }
    }
?>