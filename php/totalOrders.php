<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("./Config.php");

// Get today's date
$today = date('Y-m-d H:i:s');

// SQL query to count orders with status "COMPLETE" from the last 24 hours
$sql = "SELECT COUNT(*) AS total_complete_orders FROM orders WHERE status = 'COMPLETE' AND order_date >= '$today' - INTERVAL 24 HOUR";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$row = mysqli_fetch_assoc($result);
$totalCompleteOrders = $row['total_complete_orders'];

mysqli_stmt_close($stmt);
mysqli_close($conn);

// Output the count as JSON
header('Content-Type: application/json');
echo json_encode(['totalCompleteOrders' => $totalCompleteOrders]);
?>
