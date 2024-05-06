<?php
header('Content-Type: application/json'); // Set the correct content type
include "./Config.php";

// SQL query to fetch data for purchase orders
$sql_purchase = "SELECT MONTH(order_date) AS month, SUM(quantity) AS total_quantity 
                 FROM purchase_orders 
                 WHERE order_date >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH) 
                 GROUP BY MONTH(order_date)";

// SQL query to fetch data for sales orders
$sql_sales = "SELECT MONTH(order_date) AS month, SUM(quantity) AS total_quantity 
              FROM sales_orders 
              WHERE order_date >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH) 
              GROUP BY MONTH(order_date)";

// Execute queries and fetch results
$result_purchase = $conn->query($sql_purchase);
$result_sales = $conn->query($sql_sales);

// Prepare data arrays
$data_purchase = array();
$data_sales = array();

// Fetch and process results
while($row = $result_purchase->fetch_assoc()) {
    $data_purchase[] = $row['total_quantity'];
}

while($row = $result_sales->fetch_assoc()) {
    $data_sales[] = $row['total_quantity'];
}

if (!$result_purchase) {
    die("Error executing purchase orders query: ". $conn->error);
}

if (!$result_sales) {
    die("Error executing sales orders query: ". $conn->error);
}

$conn->close();

// Combine data arrays into a single associative array
$data = array(
    'purchase_orders' => $data_purchase,
    'sales_orders' => $data_sales
);

// Directly echo JSON-encoded data
echo json_encode($data);
?>
