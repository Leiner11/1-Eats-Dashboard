<?php
session_start();

include("./Config.php");

$foodItemId = $_POST['category'];

$totalPrice = $_POST['Price'];

$timestamp = time(); // Current Unix timestamp
$randomComponent = bin2hex(random_bytes(4)); // Generate a random component
$uniqueOrderId = $timestamp. $randomComponent; // Combine timestamp and random component

$orderDate = date('Y-m-d H:i:s');

$stallName = $_SESSION['stallname'];
$defaultStatus = 'PENDING';

if ($stmt = $conn->prepare("INSERT INTO orders (order_id, customer_name, quantity, price, product_id, order_date, status, stallname) VALUES (?,?,?,?,?,?,?,?)")) {
    $stmt->bind_param("isssssss", $uniqueOrderId, $_POST['orderFor'], $_POST['Quantity'], $totalPrice, $foodItemId, $orderDate, $defaultStatus, $stallName);
    if ($stmt->execute()) {
        echo "New record created successfully";
        header("Location:../Dashboard/index.php");
        exit;
    } else {
        echo "Error: ". $stmt->error;
    }
} else {
    echo "Prepare failed: (". $conn->errno. ") ". $conn->error;
}

$stmt->close();
$conn->close();
?>
