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
    // Optionally, set a session variable indicating successful registration
    $_SESSION['registration_success'] = true;

    // Redirect the user to the login page
    header("Location: /1-Eats-Dashboard/Login/login.html");
    exit;
} else {
    echo "Error: ". $stmt->error;
}
$stmt->close();
$conn->close();
?>
