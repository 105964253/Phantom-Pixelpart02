<?php 

session_start();

require_once("settings.php");

$conn = mysqli_connect($host, $username, $password, $database)

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>

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

<body id="managerbody">
    <section id="managerheader">
    <?php include 'header.inc'; ?>
    <?php include 'nav.inc'; ?>
    </section>

    <section id="managermain">
        <?php

        if (isset($_SESSION['username']) && $_SESSION['username'] == 'Admin') {
            echo '<h2>Welcome Admin</h2>';

            $query = "SELECT id, name, description FROM blank"; // temp db table, needs to be properly linked with the correct fields
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {   // the following is temp code from aties lecture, to be changed.
                echo '<table border="1" cellpadding="10" cellspacing="0">';
                echo '<tr><th>ID</th><th>Name</th><th>blank</th></tr>';

                while ($row = mysqli_fetch_assoc($result)) { 
                    echo '<tr>'
                    echo '<td>' . $row['id'] . '</td>';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . $row['description'] . '</td>';
                    echo '</tr>';
                }

            echo '</table>';
            }

            else {
                echo '<p>No entires found in database.</p>';
            }
        }

        else {
            echo '<h2>Un-Authorised Access</h2>'
            echo '<p>This page is for admin users only</p>'
        }
        ?>
    </section>

    <section id="loginfooter">
        <?php include 'footer.inc'; ?>
    </section>
</body>
</html>