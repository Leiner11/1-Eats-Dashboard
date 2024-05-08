<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include "./Config.php";

$stallName = $_SESSION['stallname']; // Make sure this is a string
$defaultStatus = "PENDING";

// Prepare the SQL query to fetch pending orders for the logged-in user's stall
$stmt = $conn->prepare("SELECT customer_name, id FROM orders WHERE status =? AND stallname =?");

$stmt->bind_param("ss", $defaultStatus, $stallName); 

$stmt->execute();
$result = $stmt->get_result();

$pendingOrders = [];

// Loop through the result set and add each order detail to the array
while ($row = $result->fetch_assoc()) {
    $pendingOrders[] = (object) [
        'id' => $row['id'],
        'customer_name' => $row['customer_name']
    ];
}

$stmt->close();
$conn->close();

echo json_encode($pendingOrders);
?>
