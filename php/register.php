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
    echo "Email already exists.";
    exit;
}

$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
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

    header("Location: /1-Eats-Dashboard/Login/login.html");
    exit;
} else {
    echo "Error: ". $stmt->error;
}
$stmt->close();
$conn->close();
?>
