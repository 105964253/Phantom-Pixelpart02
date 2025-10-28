<?php
    require_once("settings.php");

    $conn = mysqli_connect($host, $username, $password, $database);

    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') { // check if post was used for submitting form
        $input_username = trim($_POST['username']);
        $input_password = trim($_POST['password']);
        $hash_password = password_hash($input_password)

        $query = "INSERT INTO users (username, password) VALUES ('$username', '$hash_password')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "Signup successful. You can now login.";
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