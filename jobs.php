<?php
include 'config.php';
$result = mysqli_query($conn, "SELECT * FROM jobs");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Phantom Pixel - Jobs</title>
  <link rel="stylesheet" href="styles/styles.css">
  <link rel="stylesheet" href="styles/fonts.css">
</head>

<body id="jobsbody">
  <header id="header02">
    <div id="logo">
      <a href="index.html">
        <img src="styles/images/phantompixellogo.png" id="phantompixellogo" alt="phantom pixel logo" width="200">
      </a>
    </div>
    <nav id="header01nav">
      <a href="index.html">HOME</a>
      <a href="about.html">ABOUT</a>
      <a href="jobs.php">CAREERS</a>
      <a href="apply.html">APPLY NOW</a>
    </nav>
  </header>

  <main>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
      <section class="jobfield">
        <h2><?php echo htmlspecialchars($row['title']); ?></h2>
        <h3 class="jobrefnum">JOB REFERENCE: <?php echo htmlspecialchars($row['job_ref']); ?></h3>

        <p><strong>Title:</strong> <?php echo htmlspecialchars($row['title']); ?></p>
        <p><strong>Short Description:</strong> <?php echo htmlspecialchars($row['short_description']); ?></p>
        <p><strong>Salary:</strong> <?php echo htmlspecialchars($row['salary']); ?></p>
        <p><strong>Reporting Line:</strong> <?php echo htmlspecialchars($row['reporting_line']); ?></p>

        <!-- Key Responsibilities -->
        <h3>Key Responsibilities</h3>
        <ul>
          <?php
          $responsibilities = explode("\n", (string)$row['responsibilities']);
          foreach ($responsibilities as $item) {
            $item = trim($item);
            if ($item !== "") echo "<li>" . htmlspecialchars($item) . "</li>";
          }
          ?>
        </ul>

        <!-- Requirements -->
        <h3>Requirements</h3>
        <aside>
          <h4>Essential Requirements</h4>
          <ol>
            <?php
            $essentials = explode("\n", (string)$row['essential_requirements']);
            foreach ($essentials as $item) {
              $item = trim($item);
              if ($item !== "") echo "<li>" . htmlspecialchars($item) . "</li>";
            }
            ?>
          </ol>

          <h4>Preferable Requirements</h4>
          <ul>
            <?php
            $preferables = explode("\n", (string)$row['preferable_requirements']);
            foreach ($preferables as $item) {
              $item = trim($item);
              if ($item !== "") echo "<li>" . htmlspecialchars($item) . "</li>";
            }
            ?>
          </ul>
        </aside>

        <div>
          <a href="apply.html" class="applybutton">APPLY NOW</a>
        </div>
      </section>
      <br>
    <?php } ?>
  </main>

  <footer>
    <section class="footerlinks">
      <a href="https://www.swinburne.edu.au" target="_blank"><strong>Call us on</strong> (03) 8234 6777</a>
      <a href="mailto:PhantomPixel@gmail.com">PhantomPixel@gmail.com</a>
      <a href="https://github.com/105964253/Techops-webproject" target="_blank">GitHub</a>
      <a href="https://techops-webproject.atlassian.net/jira/software/projects/SCRUM/summary" target="_blank">Jira</a>
    </section>

    <section class="footerbottom">
      <p>Copyright &copy; 2025 Phantom Pixel. All rights reserved.</p>
    </section>
  </footer>
</body>
</html>