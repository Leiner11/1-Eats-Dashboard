<?php
include("./Config.php");

$email = $_POST['email'];
$password = $_POST['password'];

// Prepare and bind
$stmt = $conn->prepare("SELECT * FROM users WHERE email =?");
$stmt->bind_param("s", $email);

// Execute the statement
$stmt->execute();

// Get the result
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Check if user exists and password matches
if ($user && password_verify($password, $user['password'])) {
    // Password is correct, start a session
    session_start();
    $_SESSION['loggedin'] = true;
    $_SESSION['id'] = $user['id'];
    $_SESSION['name'] = $user['name'];
    header("Location: ../Dashboard/index.php");
} else {
    echo "Invalid email or password.";
}
$stmt->close();
$conn->close();
?>
