<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Recruiting Tech employees for a game development studio">
  <meta name="keywords" content="Tech, Game Development, Careers">
  <meta name="author" content="Phantom Pixel">
  <title>Phantom Pixel</title>

  <link rel="stylesheet" href="styles/styles.css">
  <link rel="stylesheet" href="styles/fonts.css">
</head>

<body id="loginbody"> 
    <section id="loginheader">
    <?php include 'header.inc'; ?>
    <?php include 'nav.inc'; ?> <!-- recycles a lot of the login page elements -->
    </section>

    <section id="login">
        <h2>Sign Up</h2>
        <?php
            if (isset($_SESSION['error'])){
                echo '<div>' .$_SESSION['error']. '</div>';
                unset($_SESSION['error']);
            }
        ?>

        <form id="loginform" action="process_signup.php" method="POST">
            <div id="username">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Choose a username" required>
            </div>

            <div id="password">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Choose a password" required>
            </div>

            <input type="submit" value="Create account">
            <p class="signuptext">Already have an account? <a href="login.php">Log in</a></p>
        </form>
    </section>

    <section id="loginfooter">
    <?php include 'footer.inc'; ?>
    </section>
</body>
</html> 