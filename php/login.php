<?php
include("./Config.php");
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$email = $_POST['email'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM users WHERE email =?");
$stmt->bind_param("s", $email);

$stmt->execute();

$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Check if user exists and password matches
if ($user && password_verify($password, $user['password'])) {
    // Password is correct, start a session
    $_SESSION['loggedin'] = true;
    $_SESSION['id'] = $user['id'];
    $_SESSION['name'] = $user['name'];
    $_SESSION['stallname'] = $user['stallname'];
    
    echo "Username: ". $_SESSION['name'];

    header("Location:../Dashboard/index.php");
} else {
    echo "Invalid email or password.";
}
$stmt->close();
$conn->close();
?>
