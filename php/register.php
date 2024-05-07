<?php
//session_start();
require_once './Config.php';

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$password_confirmation = $_POST['password_confirmation'];
$stallname = $_POST['stallname'];
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

// Update the SQL query to include the stallname
$sql = "INSERT INTO users (name, email, password, stallname) VALUES (?,?,?,?)";

$stmt = $conn->prepare($sql);

$stmt->bind_param("ssss", $name, $email, $hashedPassword, $stallname);

if ($stmt->execute()) {
    header("Location: /1-Eats-Dashboard/Dashboard/index.php");
    exit;
} else {
    echo "Error: ". $stmt->error;
}
$stmt->close();
$conn->close();
?>
