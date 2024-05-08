<?php
session_start();
include "./Config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $orderId = $_POST['orderId'];
    $status = $_POST['status'];

    if (!isset($orderId) || empty($orderId)) {
        die("Order ID is missing.");
    }
    if (!isset($status) || empty($status)) {
        die("Status is missing.");
    }

    // Echo the fetched orderId and status
    echo "Fetched Order ID: ". $orderId. "<br>";
    echo "Fetched Status: ". $status. "<br>";

    $stmt = $conn->prepare("UPDATE orders SET status =? WHERE id =?");
    $stmt->bind_param("si", $status, $orderId);

    if (!$stmt->execute()) {
        echo "Failed to update order status.<br>";
        echo "Error: ". $stmt->error;
    } else {
        echo "Order status updated successfully.<br>";
        echo "Rows affected: ". mysqli_affected_rows($conn);
    }    
        // Redirect to a different HTML page
        header("Location:../Controller-UI/successStatusUpdate.php");
        exit;

    $stmt->close();
    $conn->close();
} else {
    header("Location:../Dashboard/index.php");
    exit;
}
?>
