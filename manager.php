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
    $_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset($_POST['id']) &&
    !isset($_POST['action'])
) {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $status = $_POST['status'] ?? '';
    $allowed = ['New', 'Current', 'Final'];
    if ($id > 0 && in_array($status, $allowed, true)) {
        $stmt = mysqli_prepare($conn, "UPDATE eoi SET Status=? WHERE EOInumber=?");
        mysqli_stmt_bind_param($stmt, "si", $status, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    header("Location: " . $_SERVER['PHP_SELF'] . (!empty($_POST['return_qs']) ? ('?' . $_POST['return_qs']) : ''));
    exit;
}

if (
    isset($_SESSION['username']) &&
    $_SESSION['username'] === 'Admin' &&
    $_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset($_POST['action']) &&
    $_POST['action'] === 'bulk_delete'
) {
    $ids = $_POST['del_ids'] ?? [];
    $ids = array_values(array_map('intval', array_filter($ids, 'is_numeric')));
    if (!empty($ids)) {
        mysqli_begin_transaction($conn);
        try {
            $delStmt = mysqli_prepare($conn, "DELETE FROM eoi WHERE EOInumber = ?");
            foreach ($ids as $eid) {
                mysqli_stmt_bind_param($delStmt, "i", $eid);
                mysqli_stmt_execute($delStmt);
            }
            mysqli_stmt_close($delStmt);
            mysqli_commit($conn);
        } catch (Throwable $e) {
            mysqli_rollback($conn);
        }
    }
    header("Location: " . $_SERVER['PHP_SELF'] . (!empty($_POST['return_qs']) ? ('?' . $_POST['return_qs']) : ''));
    exit;
}

$currentSortKey = $_GET['sort'] ?? 'applied_desc';
$jobFilter = trim($_GET['jobref'] ?? '');

$SORT_LABELS = [ // sorting options available in dropdown
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

$sql = "SELECT EOInumber, JobRef, FirstName, LastName, Email, MobilePhone, State, Postcode, Skills, Status, DateApplied FROM eoi";
if ($jobFilter !== '') { // filtering by job reference entered
    $sql .= " WHERE JobRef LIKE ?";
}
$sql .= " ORDER BY $orderby";

if ($jobFilter !== '') { 
    $stmt = mysqli_prepare($conn, $sql);
    $pattern = "%$jobFilter%";
    mysqli_stmt_bind_param($stmt, "s", $pattern);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
} else {
    $res = mysqli_query($conn, $sql);
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

    <style> /* having issues getting styling to work within styles.css, so opted for embeded styling which did */
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
        #sortbar input[type="text"] {
            border-radius: 4px;
            border: 1px solid #651AE8;
        }
        table td:first-child, table th:first-child {
            width: 42px;
            text-align: center;
            background: #f9f7ff;
        }
        #sortfunction1 {
            max-width: 600px;          
            margin: 10px auto;          
            background: #ffffff;        
            padding: 12px;              
            border-radius: 10px;       
            box-shadow: 0 0 10px rgba(0,0,0,0.1); 
            text-align: center;        
            display: flex;
            justify-content: center;
            gap: 20px;                  
        }   
        #sortfunction2 {
            max-width: 400px;
            margin: 20px auto;          
            background: #ffffff;        
            padding: 15px;              
            border-radius: 10px;       
            box-shadow: 0 0 10px rgba(0,0,0,0.1); 
            text-align: center;       
            display: flex;
            justify-content: space-evenly;
        }
        #sortfunction2 #buttons {
            display: flex;
            gap: 50px;
        }
    </style>

    <script> // script for deleting entries from db - assisted by ai
        function toggleAll(source) {
            document.querySelectorAll('.delbox').forEach(b => b.checked = source.checked);
        }
        function selectAll() {
            document.querySelectorAll('.delbox').forEach(b => b.checked = true);
            const m = document.getElementById('del_master');
            if (m) m.checked = true;
        }
        function clearAll() {
            document.querySelectorAll('.delbox').forEach(b => b.checked = false);
            const m = document.getElementById('del_master');
            if (m) m.checked = false;
        }
        function confirmDelete() {
            return confirm("Delete all selected EOI entries? This cannot be undone.");
        }
    </script>
</head>

<body id="loginbody">
    <section id="pageheader">
        <?php include 'header.inc'; ?>
        <?php include 'nav.inc'; ?>
    </section>

    <h2>Welcome, Admin</h2>

    <section id="managermain">
        <?php if (isset($_SESSION['username']) && $_SESSION['username'] === 'Admin'): ?>

            <section id="sortfunction1"> <!-- sort function sections for styling -->
                <form id="sortbar" method="get">
                    <label for="sort">Sort by:&nbsp;</label>
                    <select id="sort" name="sort" onchange="this.form.submit()">
                        <?php foreach ($SORT_LABELS as $key => $label): ?>
                            <option value="<?= htmlspecialchars($key) ?>" <?= ($key === $currentSortKey ? 'selected' : '') ?>>
                                <?= htmlspecialchars($label) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    &nbsp;&nbsp;
                    <label for="jobref">Filter by Job Ref:&nbsp;</label>
                    <input type="text" id="jobref" name="jobref" value="<?= htmlspecialchars($jobFilter) ?>" placeholder="e.g. DEV001">
                    <noscript><button type="submit">Apply</button></noscript>
                </form>
            </section>

            <?php if ($res && mysqli_num_rows($res) > 0): ?>

                <section id="sortfunction2">
                    <form id="bulkDeleteForm" method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" onsubmit="return confirmDelete()">
                        <input type="hidden" name="action" value="bulk_delete">
                        <input type="hidden" name="return_qs" value="<?= htmlspecialchars($_SERVER['QUERY_STRING'] ?? '') ?>">
                    </form>

                    <div id="buttons">
                        <button type="button" onclick="selectAll()">Select all</button>
                        <button type="button" onclick="clearAll()">Clear all</button>
                        <button type="submit" form="bulkDeleteForm">Delete selected</button>
                    </div>
                </section>

                <table> <!-- main table pulling data from db -->
                    <tr>
                        <th><input type="checkbox" id="del_master" onclick="toggleAll(this)" title="Select all on this page"></th>
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
                            <td class="nowrap">
                                <input type="checkbox" class="delbox" name="del_ids[]" value="<?= (int)$row['EOInumber'] ?>" form="bulkDeleteForm">
                            </td>
                            <td class="nowrap"><?= (int)$row['EOInumber'] ?></td>
                            <td><?= htmlspecialchars($row['FirstName'] . ' ' . $row['LastName']) ?></td>
                            <td class="nowrap"><?= htmlspecialchars($row['JobRef']) ?></td>
                            <td>
                                <div><?= htmlspecialchars($row['Email']) ?></div>
                                <div><?= htmlspecialchars($row['MobilePhone']) ?></div>
                            </td>
                            <td class="nowrap"><?= htmlspecialchars($row['State']) ?> <?= htmlspecialchars($row['Postcode']) ?></td>
                            <td><?= nl2br(htmlspecialchars($row['Skills'])) ?></td>
                            <td>
                                <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                                    <input type="hidden" name="id" value="<?= (int)$row['EOInumber'] ?>">
                                    <input type="hidden" name="return_qs" value="<?= htmlspecialchars($_SERVER['QUERY_STRING'] ?? '') ?>">
                                    <select name="status">
                                        <?php foreach (['New', 'Current', 'Final'] as $opt): ?>
                                            <option value="<?= htmlspecialchars($opt) ?>" <?= ($row['Status'] === $opt ? 'selected' : '') ?>>
                                                <?= htmlspecialchars($opt) ?>
                                            </option>
                                        <?php endforeach; ?>
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
                <p>No entries found.</p>
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
