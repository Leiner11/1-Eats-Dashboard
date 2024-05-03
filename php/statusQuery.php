<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("./Config.php");

// Get today's date
$today = date('Y-m-d');

// SQL query to count orders with status "ACTIVE" for today
$sql = "SELECT COUNT(*) AS total_orders FROM orders WHERE status = 'ACTIVE' AND DATE(order_date) = '$today'";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_execute($stmt);

// Get the result
$result = mysqli_stmt_get_result($stmt);

// Fetch the count
$row = mysqli_fetch_assoc($result);
$totalOrders = $row['total_orders'];

mysqli_stmt_close($stmt);
mysqli_close($conn);

header('Content-Type: application/json');
echo json_encode(['totalOrders' => $totalOrders]);

?>