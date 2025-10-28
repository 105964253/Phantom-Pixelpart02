<?php
// Show PHP errors while developing (remove before submitting if asked)
error_reporting(E_ALL); ini_set('display_errors', 1);

/* Connect to DB */
include 'config.php';

/* Get all jobs */
$sql = "SELECT * FROM jobs";
$result = mysqli_query($conn, $sql);
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
  <!-- Header -->
  <header id="header02">
    <div id="logo">
      <a href="index.html"><img src="styles/images/phantompixellogo.png" id="phantompixellogo" alt="phantom pixel logo" width="200"></a>
    </div>
    <nav id="header01nav">
      <a href="index.html">HOME</a>
      <a href="about.html">ABOUT</a>
      <a href="jobs.php">CAREERS</a>
      <a href="apply.html">APPLY NOW</a>
    </nav>
  </header>

  <main>
    <?php
    // If there are no jobs, show a friendly message (rubric polish)
    if (!$result || mysqli_num_rows($result) === 0) {
      echo "<p>No jobs available right now. Please check again later.</p>";
    }

    // Loop through jobs
    while ($row = $result ? mysqli_fetch_assoc($result) : null) {
    ?>
      <section class="jobfield">
        <h2><?php echo htmlspecialchars($row['title']); ?></h2>
        <h3 class="jobrefnum">JOB REFERENCE: <?php echo htmlspecialchars($row['job_ref']); ?></h3>

        <p><strong>Title:</strong> <?php echo htmlspecialchars($row['title']); ?></p>
        <p><strong>Short Description:</strong> <?php echo htmlspecialchars($row['short_description']); ?></p>
        <p><strong>Salary:</strong> <?php echo htmlspecialchars($row['salary']); ?></p>
        <p><strong>Reporting Line:</strong> <?php echo htmlspecialchars($row['reporting_line']); ?></p>

        <h3>Key Responsibilities</h3>
        <ul>
          <?php
          foreach (explode("\n", (string)$row['responsibilities']) as $item) {
            $item = trim($item);
            if ($item !== "") echo "<li>".htmlspecialchars($item)."</li>";
          }
          ?>
        </ul>

        <h3>Requirements</h3>
        <aside>
          <h4>Essential Requirements</h4>
          <ol>
            <?php
            foreach (explode("\n", (string)$row['essential_requirements']) as $item) {
              $item = trim($item);
              if ($item !== "") echo "<li>".htmlspecialchars($item)."</li>";
            }
            ?>
          </ol>

          <h4>Preferable Requirements</h4>
          <ul>
            <?php
            foreach (explode("\n", (string)$row['preferable_requirements']) as $item) {
              $item = trim($item);
              if ($item !== "") echo "<li>".htmlspecialchars($item)."</li>";
            }
            ?>
          </ul>
        </aside>

        <div>
          <a href="apply.html?job=<?php echo urlencode($row['job_ref']); ?>" class="applybutton">APPLY NOW</a>
        </div>
      </section>
      <br>
    <?php } ?>
  </main>

  <!-- Footer -->
  <?php include 'footer.inc'; ?>
</body>
</html>
