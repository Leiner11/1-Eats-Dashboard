<?php
//session_start();
require_once './Config.php';

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$password_confirmation = $_POST['password_confirmation'];

$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

    $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";

$stmt = $conn->prepare($sql);

$stmt->bind_param("sss", $name, $email, $hashedPassword);

if ($stmt->execute()) {
    header("Location: /1-Eats-Dashboard/Dashboard/index.php");
    exit;
} else {
    echo "Error: " . $stmt->error;
}
$stmt->close();
$conn->close();
?>