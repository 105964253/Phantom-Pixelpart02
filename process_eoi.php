<?php
// ----------------------------------------------
// process_eoi.php
// Handles EOI form submission for Phantom Pixel
// ----------------------------------------------

require_once("settings.php"); // include DB connection

// Prevent direct access
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: apply.php");
    exit();
}

// Sanitisation function
function sanitise_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Retrieve and sanitise form data
$jobref        = sanitise_input($_POST['jobref'] ?? '');
$firstname     = sanitise_input($_POST['firstname'] ?? '');
$lastname      = sanitise_input($_POST['lastname'] ?? '');
$dob           = sanitise_input($_POST['dob'] ?? '');
$gender        = sanitise_input($_POST['gender'] ?? '');
$address       = $_POST['address'] ?? [];  // array of street, suburb, postcode, state
$email         = sanitise_input($_POST['email'] ?? '');
$hnum          = sanitise_input($_POST['hnum'] ?? '');
$pnum          = sanitise_input($_POST['pnum'] ?? '');
$skills        = $_POST['skills'] ?? [];   // array of selected checkboxes
$skillcomment  = sanitise_input($_POST['skillcomment'] ?? '');
$status        = "New"; // default value

// handle address array safely
$street   = isset($address[0]) ? sanitise_input($address[0]) : '';
$suburb   = isset($address[1]) ? sanitise_input($address[1]) : '';
$postcode = isset($address[2]) ? sanitise_input($address[2]) : '';
$state    = isset($address[3]) ? sanitise_input($address[3]) : '';

// convert skills array into comma-separated string
$skills_str = !empty($skills) ? implode(", ", $skills) : '';

// Server-side validation
$errors = [];

if (empty($jobref) || !preg_match("/^[A-Za-z0-9]{5}$/", $jobref))
    $errors[] = "Job Reference Number must be 5 alphanumeric characters.";

if (empty($firstname) || !preg_match("/^[A-Za-z\s'-]{2,20}$/", $firstname))
    $errors[] = "First name must contain only letters and be 2–20 characters long.";

if (empty($lastname) || !preg_match("/^[A-Za-z\s'-]{2,20}$/", $lastname))
    $errors[] = "Last name must contain only letters and be 2–20 characters long.";

if (empty($dob))
    $errors[] = "Date of birth is required.";

if (empty($gender))
    $errors[] = "Gender selection is required.";

if (empty($street) || empty($suburb) || empty($postcode) || empty($state))
    $errors[] = "Complete address details are required.";

if (!preg_match("/^\d{4}$/", $postcode))
    $errors[] = "Postcode must be exactly 4 digits.";

if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    $errors[] = "Invalid email address.";

if (empty($pnum) || !preg_match("/^\+?\d{8,12}$/", $pnum))
    $errors[] = "Mobile phone must contain 8–12 digits.";

if (!empty($hnum) && !preg_match("/^\+?\d{8,12}$/", $hnum))
    $errors[] = "Home phone must contain 8–12 digits if provided.";

// If any validation fails, display errors
if (!empty($errors)) {
    echo "<h2>Validation Errors</h2><ul>";
    foreach ($errors as $err) {
        echo "<li>$err</li>";
    }
    echo "</ul><a href='apply.php'>Go Back</a>";
    exit();
}

// Connect to database
$conn = @mysqli_connect($host, $user, $pwd, $sql_db);
if (!$conn) {
    die("<p>Database connection failure: " . mysqli_connect_error() . "</p>");
}

//  Create the EOI table if not exists (Task 3)
$create_table = "
CREATE TABLE IF NOT EXISTS eoi (
  EOInumber INT AUTO_INCREMENT PRIMARY KEY,
  JobRef VARCHAR(5) NOT NULL,
  FirstName VARCHAR(20) NOT NULL,
  LastName VARCHAR(20) NOT NULL,
  DOB DATE NOT NULL,
  Gender VARCHAR(20) NOT NULL,
  StreetAddress VARCHAR(100) NOT NULL,
  Suburb VARCHAR(50) NOT NULL,
  Postcode VARCHAR(10) NOT NULL,
  State VARCHAR(10) NOT NULL,
  Email VARCHAR(100) NOT NULL,
  HomePhone VARCHAR(15),
  MobilePhone VARCHAR(15) NOT NULL,
  Skills VARCHAR(255),
  SkillComment TEXT,
  Status ENUM('New', 'Current', 'Final') DEFAULT 'New',
  DateApplied TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
mysqli_query($conn, $create_table);

// Insert form data
$insert_sql = "
INSERT INTO eoi
(JobRef, FirstName, LastName, DOB, Gender, StreetAddress, Suburb, Postcode, State, Email, HomePhone, MobilePhone, Skills, SkillComment, Status)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $insert_sql);
mysqli_stmt_bind_param($stmt, "sssssssssssssss", 
    $jobref, $firstname, $lastname, $dob, $gender, 
    $street, $suburb, $postcode, $state, $email, 
    $hnum, $pnum, $skills_str, $skillcomment, $status);

if (mysqli_stmt_execute($stmt)) {
    $eoi_id = mysqli_insert_id($conn);
    echo "<h2>✅ Application Submitted Successfully!</h2>";
    echo "<p>Your Expression of Interest Number is: <strong>$eoi_id</strong></p>";
    echo "<p>Thank you, $firstname $lastname, for applying to Phantom Pixel!</p>";
} else {
    echo "<p>❌ There was an error submitting your application. Please try again later.</p>";
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
