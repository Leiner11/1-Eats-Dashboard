<?php
include("./Config.php");

// total sales for the last 24 hours
$sql = "SELECT SUM(amount) AS total_sales FROM sales WHERE order_date >= NOW() - INTERVAL 24 HOUR";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $total_sales = $row["total_sales"];
    }
} else {
    echo "No sales found in the last 24 hours.";
}
$conn->close();

// Return the total sales as JSON
header('Content-Type: application/json'); // Set the correct content type
echo json_encode(array("total_sales" => $total_sales));
?>
