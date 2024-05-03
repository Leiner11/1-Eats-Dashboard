<?php
header('Content-Type: application/json'); // Set the correct content type
include "./Config.php";

// SQL query to fetch data
$sql = "SELECT MONTH(order_date) AS month, SUM(quantity) AS total_quantity, 'Purchase Orders' AS order_type FROM purchase_orders 
WHERE order_date >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH) 
GROUP BY month, order_type 
UNION ALL SELECT MONTH(order_date) 
AS month, SUM(quantity) AS total_quantity, 'Sales Orders' AS order_type FROM sales_orders WHERE order_date >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH) 
GROUP BY month, order_type";

$result = $conn->query($sql);

$data = array();
while($row = $result->fetch_assoc()) {
    $data[] = $row['total_quantity'];
}

$conn->close();

// Directly echo JSON-encoded data
echo json_encode($data);
?>
