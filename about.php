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
        <dt>Vidhi Patel <span class="member-id">105235713</span></dt>
        <dd>
          <strong>Contribution:</strong> About Page Developer & Coordinator.<br>
          <strong>Favourite Language:</strong> HTML & CSS — “Designing experiences that look and feel right.”<br>
          <em>Translation:</em> “Concevoir des expériences qui semblent justes et intuitives.”<br>
          <strong>Email:</strong> <a href="mailto:105235713@student.swin.edu.au">105235713@student.swin.edu.au</a>
        </dd>

        <dt>Piseth Iv <span class="member-id">105964253</span></dt>
        <dd>
          <strong>Contribution:</strong> Index Page Developer.<br>
          <strong>Favourite Language:</strong> HTML — “Code once, scale everywhere.”<br>
          <em>Translation:</em> “Coder une fois, évoluer partout.”<br>
          <strong>Email:</strong> <a href="mailto:105964253@student.swin.edu.au">105964253@student.swin.edu.au</a>
        </dd>

        <dt>Max Domoney <span class="member-id">106109000</span></dt>
        <dd>
          <strong>Contribution:</strong> Apply Page Developer.<br>
          <strong>Favourite Language:</strong> AutoHotkey — “Automating tasks, one script at a time.”<br>
          <em>Translation:</em> “Automatiser les tâches, un script à la fois.”<br>
          <strong>Email:</strong> <a href="mailto:106109000@student.swin.edu.au">106109000@student.swin.edu.au</a>
        </dd>

        <dt>MD Areen <span class="member-id">105693861</span></dt>
        <dd>
          <strong>Contribution:</strong> Careers Page Developer.<br>
          <strong>Favourite Language:</strong> PHP — “The web’s silent workhorse.”<br>
          <em>Translation:</em> “Le cheval de bataille silencieux du web.”<br>
          <strong>Email:</strong> <a href="mailto:105693861@student.swin.edu.au">105693861@student.swin.edu.au</a>
        </dd>
      </dl>
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
          <tr>
            <td>Vidhi Patel</td>
            <td>UX Designer</td>
            <td>Soft drinks</td>
            <td>Ahmedabad, India</td>
          </tr>
          <tr>
            <td>Piseth Iv</td>
            <td>Data Scientist</td>
            <td>Bundaberg & Chips</td>
            <td>Phnom Penh, Cambodia</td>
          </tr>
          <tr>
            <td>Max Domoney</td>
            <td>Front End Developer</td>
            <td>Chocolates</td>
            <td>Melbourne, Australia</td>
          </tr>
          <tr>
            <td>MD Areen</td>
            <td>Backend Developer</td>
            <td>Trail Mix</td>
            <td>Dhaka, Bangladesh</td>
          </tr>
        </tbody>
      </table>
    </section>
  </main>

  <!-- Shared Footer -->
  <?php include 'footer.inc'; ?>
</body>
</html>