<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("./Config.php");

session_start();

// Check if the 'stallname' session variable is set
if (isset($_SESSION['stallname'])) {
    $loggedInStallName = $_SESSION['stallname'];

    $today = date('Y-m-d H:i:s');

    // SQL query to count orders with status "COMPLETE" from the last 24 hours for the logged-in user's stallname
    $sql = "SELECT COUNT(*) AS total_complete_orders FROM orders WHERE status = 'COMPLETE' AND order_date >=? AND stallname =?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "ss", $today, $loggedInStallName);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $row = mysqli_fetch_assoc($result);
    $totalCompleteOrders = $row['total_complete_orders'];

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    header('Content-Type: application/json');
    echo json_encode(['totalCompleteOrders' => $totalCompleteOrders]);
} else {
    // If 'stallname' is not set, return an error message
    http_response_code(401); // Unauthorized
    echo json_encode(['error' => 'Unauthorized: Please log in first.']);
}
?>
