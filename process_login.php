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

    if ($input_username === '' || $input_password === '') {
        $_SESSION['error'] = "Please enter both username and password.";
        header('Location: login.php');
        exit;
    }

    $query = "SELECT username, password FROM users WHERE username = ? LIMIT 1"; 
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $input_username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);


    if ($user = mysqli_fetch_assoc($result)) {
        if (password_verify($input_password, $user['password'])) {

            session_regenerate_id(true);
            $_SESSION['username'] = $user['username'];

            if ($user['username'] === 'Admin') {
                header('Location: manager.php');
                exit;
            } else {
                header('Location: index.php');
                exit;
            }
        }
    }

    $_SESSION['error'] = "Invalid username or password. Please try again.";
    header('Location: login.php');
    exit;

} else {
    header('Location: login.php');
    exit;
}
?>