<?php
include("./Config.php");

// Generate a unique order ID
$uniqueOrderId = uniqid('order_');

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO orders (order_id, customer_name, quantity) VALUES (?,?,?)");
$stmt->bind_param("iss", $uniqueOrderId, $_POST['orderFor'], $_POST['Quantity']);

if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: ". $sql. "<br>". $conn->error;
}

$stmt->close();
$conn->close();

header("Location: ../Dashboard/index.php");
exit;
?>
