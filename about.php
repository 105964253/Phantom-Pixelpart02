<?php
require_once 'settings.php';

$result = mysqli_query($conn, "SELECT * FROM about_members ORDER BY member_name");
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
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

<body id="aboutbody">
    <section id="pageheader">
      <?php include 'header.inc'; ?>
      <?php include 'nav.inc'; ?>
      </header>
    </section>
  <!-- Main Content -->
  <main>
    <!-- Group Details -->
    <section class="about-section">
      <h1>Group Information</h1>
      <ul>
        <li><strong>Group Name:</strong> Phantom Pixel – G01</li>
        <li><strong>Class Day/Time:</strong>
          <ul>
            <li>Wednesday, 12:30 PM – 2:30 PM</li>
          </ul>
        </li>
      </ul>
    </section>

    <!-- Team Contributions -->
    <section class="about-section">
      <h2>Team Member Contributions & Quotes</h2>
      <dl class="members">
        <?php
        mysqli_data_seek($result, 0);
        while ($member = mysqli_fetch_assoc($result)):
        ?>
          <dt><?= htmlspecialchars($member['member_name']) ?> <span class="member-id"><?= htmlspecialchars($member['student_id']) ?></span></dt>
          <dd>
            <strong>Contribution:</strong> <?= htmlspecialchars($member['contribution']) ?><br>
            <strong>Favourite Language:</strong> <?= htmlspecialchars($member['favourite_language']) ?><br>
            <em><strong>Translation:</strong></em> <?= htmlspecialchars($member['translation']) ?><br>
            <strong>Email:</strong> <a href="mailto:<?= htmlspecialchars($member['email']) ?>"><?= htmlspecialchars($member['email']) ?></a>
          </dd>
        <?php endwhile; ?>
      </dl>
    </section>

    <section class="about-section">
      <h2>Project Contributions</h2>
      <?php
      mysqli_data_seek($result, 0);
      while ($member = mysqli_fetch_assoc($result)):
      ?>
        <div class="project-contribution-box">
          <h3><?= htmlspecialchars($member['member_name']) ?></h3>
          <div class="project-item">
            <strong class="project-label">Project 1 Contributions:</strong>
            <p><?= htmlspecialchars($member['project1_contribution']) ?></p>
          </div>
          <div class="project-item">
            <strong class="project-label">Project 2 Contributions:</strong>
            <p><?= htmlspecialchars($member['project2_contribution']) ?></p>
          </div>
        </div>
      <?php endwhile; ?>
    </section>

    <!-- Group Photo -->
    <figure class="team-figure">
      <img src="styles/Images/Groupphoto.jpg" alt="Phantom Pixel Team Group Photo" width="900">
      <figcaption>Phantom Pixel – Group G01 Team</figcaption>
    </figure>

    <!-- Fun Facts -->
    <section class="about-section">
      <h2>Fun Facts</h2>
      <table class="funfacts">
        <caption>Discover More About Our Team</caption>
        <thead>
          <tr>
            <th scope="col">Member</th>
            <th scope="col">Dream Job</th>
            <th scope="col">Coding Snack</th>
            <th scope="col">Hometown</th>
          </tr>
        </thead>
        <tbody>
          <?php
          mysqli_data_seek($result, 0); 
          while ($member = mysqli_fetch_assoc($result)):
          ?> <!-- Taken from atie manage page code to fetch data --> <!-- mysqli_data_seek($result, 0) used to ensure the data is read from the start of the table -->
            <tr>
              <td><?= htmlspecialchars($member['member_name']) ?></td> <!-- htmlspecialchars taken from atie manage page to prevent xss attacks -->
              <td><?= htmlspecialchars($member['dream_job']) ?></td>
              <td><?= htmlspecialchars($member['coding_snack']) ?></td>
              <td><?= htmlspecialchars($member['hometown']) ?></td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </section>
  </main>

  <!-- Shared Footer -->
  <?php include 'footer.inc'; ?>
</body>
</html>