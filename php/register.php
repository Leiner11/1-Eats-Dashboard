<?php
session_start();
require_once './Config.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$password_confirmation = $_POST['password_confirmation'];
$stallname = $_POST['stallname'];

// Check if email already exists
$stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE email =?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$count = $result->fetch_row()[0];

if ($count > 0) {
    $_SESSION['error_message'] = 'Error: Email already exists.';
    header("Location:../Register/register.php");
    exit;
}

// Simplified password validation: only check for minimum length
$minPasswordLength = 8; // Minimum password length

if (strlen($password) < $minPasswordLength) {
    $_SESSION['error_message'] = 'Password should be at least 8 characters long. Please try again.';
    header("Location:../Register/register.php");
    exit;
}

if ($password!== $password_confirmation) {
    $_SESSION['unmatched_message'] = 'Error: Passwords do not match.';
    header("Location:../Register/register.php");
    exit;
}

$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

if ($conn->connect_error) {
    die("Error: Connection failed: ". $conn->connect_error);
}

$sql = "INSERT INTO users (name, email, password, stallname) VALUES (?,?,?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $name, $email, $hashedPassword, $stallname);

if ($stmt->execute()) {
    // Check if the stallname already exists in the stalls table
    $checkStallNameStmt = $conn->prepare("SELECT COUNT(*) FROM stalls WHERE name =?");
    $checkStallNameStmt->bind_param("s", $stallname);
    $checkStallNameStmt->execute();
    $checkResult = $checkStallNameStmt->get_result();
    $checkCount = $checkResult->fetch_row()[0];

    if ($checkCount == 0) {
        // If the stallname does not exist, insert it into the stalls table
        $insertStallStmt = $conn->prepare("INSERT INTO stalls (name) VALUES (?)");
        $insertStallStmt->bind_param("s", $stallname);
        $insertStallStmt->execute();
    }

    $_SESSION['registration_success'] = true;

    header("Location: /1-Eats-Dashboard/Login/loginPage.php");
    exit;
} else {
    echo "Error: ". $stmt->error;
}
$stmt->close();
$conn->close();
?>
