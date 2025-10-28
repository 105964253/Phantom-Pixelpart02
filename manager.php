<?php
session_start();
require_once("settings.php");

$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

if (
    isset($_SESSION['username']) &&
    $_SESSION['username'] === 'Admin' &&
    $_SERVER['REQUEST_METHOD'] === 'POST'
) {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $status = $_POST['status'] ?? '';
    $allowed = ['New','Current','Final'];
    if ($id > 0 && in_array($status, $allowed, true)) {
        $stmt = mysqli_prepare($conn, "UPDATE eoi SET Status=? WHERE EOInumber=?");
        mysqli_stmt_bind_param($stmt, "si", $status, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
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
  <title>Phantom Pixel — Manager</title>

  <link rel="stylesheet" href="styles/styles.css">
  <link rel="stylesheet" href="styles/fonts.css">
  <style>
    table { 
        border-collapse: collapse; 
        width: 100%; 
        max-width: 1200px; 
        margin: 20px auto;
    }
    th, td { 
        border: 1px solid #651AE8; 
        padding: 10px; 
        text-align: left; 
        vertical-align: top;
        background: #f3f3f1;
    }
    th {
        color: #ffffff;
        background: #0a121c;
        font-family: Pixelade; 
    }
    form { 
        margin: 0; 
    }
    .nowrap { 
        white-space: nowrap; 
    }
    h2 {
        text-align: center;
    }
    #sortbar {
        max-width:1200px;
        margin:10px auto 20px;
    }

  </style>
</head>

<body id="loginbody">
  <section id="pageheader">
    <?php include 'header.inc'; ?>
    <?php include 'nav.inc'; ?>
  </section>

  <h2>Welcome, Admin</h2>

  <section id="managermain">
  <?php if (isset($_SESSION['username']) && $_SESSION['username'] === 'Admin'): ?>
    
  <form id="sortbar" method="get">
    <label for="sort">Sort by:&nbsp;</label>
    <select id="sort" name="sort" onchange="this.form.submit()">
        <?php
        $SORT_LABELS = [
            'applied_desc' => 'Applied (newest first)',
            'applied_asc'  => 'Applied (oldest first)',
            'eoi_desc'     => 'EOI # (high → low)',
            'eoi_asc'      => 'EOI # (low → high)',
            'name_asc'     => 'Name (A → Z)',
            'name_desc'    => 'Name (Z → A)',
            'jobref_asc'   => 'Job Ref (A → Z)',
            'jobref_desc'  => 'Job Ref (Z → A)',
            'status_asc'   => 'Status (A → Z)',
            'status_desc'  => 'Status (Z → A)',
            'state_asc'    => 'State (A → Z)',
            'state_desc'   => 'State (Z → A)',
        ];
        foreach ($SORT_LABELS as $key => $label) {
            $sel = ($key === $currentSortKey) ? 'selected' : '';
            echo '<option value="'.htmlspecialchars($key).'" '.$sel.'>'.htmlspecialchars($label).'</option>';
        }
        ?>
    </select>
    <noscript><button type="submit">Apply</button></noscript>
  </form>  

    <?php 
      $currentSortKey = $_GET['sort'] ?? 'applied_desc'; 
      $SORT_MAP = [
        'applied_desc' => 'DateApplied DESC',
        'applied_asc'  => 'DateApplied ASC',
        'eoi_desc'     => 'EOInumber DESC',
        'eoi_asc'      => 'EOInumber ASC',
        'name_asc'     => 'LastName ASC, FirstName ASC',
        'name_desc'    => 'LastName DESC, FirstName DESC',
        'jobref_asc'   => 'JobRef ASC',
        'jobref_desc'  => 'JobRef DESC',
        'status_asc'   => 'Status ASC',
        'status_desc'  => 'Status DESC',
        'state_asc'    => 'State ASC',
        'state_desc'   => 'State DESC',
        ];
      $orderby = $SORT_MAP[$currentSortKey] ?? 'DateApplied DESC';

      $res = mysqli_query($conn, "SELECT EOInumber, JobRef, FirstName, LastName, Email, MobilePhone, State, Postcode, Skills, Status, DateApplied FROM eoi ORDER BY $orderby");
      if ($res && mysqli_num_rows($res) > 0):

    ?>
      <table>
        <tr>
          <th class="nowrap">EOI #</th>
          <th>Name</th>
          <th class="nowrap">Job Ref</th>
          <th>Contact</th>
          <th>Address</th>
          <th>Skills</th>
          <th class="nowrap">Status</th>
          <th class="nowrap">Save</th>
          <th class="nowrap">Applied</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($res)): ?>
          <tr>
            <td class="nowrap"><?= (int)$row['EOInumber'] ?></td>
            <td>
              <?= htmlspecialchars($row['FirstName'] . ' ' . $row['LastName']) ?>
            </td>
            <td class="nowrap"><?= htmlspecialchars($row['JobRef']) ?></td>
            <td>
              <div><?= htmlspecialchars($row['Email']) ?></div>
              <div><?= htmlspecialchars($row['MobilePhone']) ?></div>
            </td>
            <td class="nowrap">
              <?= htmlspecialchars($row['State']) ?> <?= htmlspecialchars($row['Postcode']) ?>
            </td>
            <td><?= nl2br(htmlspecialchars($row['Skills'])) ?></td>
            <td>
                <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                <input type="hidden" name="id" value="<?= (int)$row['EOInumber'] ?>">
                <input type="hidden" name="return_qs" value="<?= htmlspecialchars($_SERVER['QUERY_STRING'] ?? '') ?>">
                <select name="status">
                  <?php
                    $opts = ['New','Current','Final'];
                    foreach ($opts as $opt) {
                      $sel = ($row['Status'] === $opt) ? 'selected' : '';
                      echo '<option value="'.htmlspecialchars($opt).'" '.$sel.'>'.htmlspecialchars($opt).'</option>';
                    }
                  ?>
                </select>
            </td>
            <td>
                <input type="submit" value="Save">
              </form>
            </td>
            <td class="nowrap"><?= htmlspecialchars($row['DateApplied']) ?></td>
          </tr>
        <?php endwhile; ?>
      </table>
    <?php else: ?>
      <p>No EOI entries found.</p>
    <?php endif; ?>

  <?php else: ?>
    <h2>Unauthorised Access</h2>
    <p>This page is for admin users only.</p>
  <?php endif; ?>
  </section>

  <section id="loginfooter">
    <?php include 'footer.inc'; ?>
  </section>
</body>
</html>