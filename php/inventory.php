<?php
include("./Config.php");
// SQL to fetch inventory data
$sql = "SELECT * FROM inventory";
$result = $conn->query($sql);

$inventoryData = array();

while($row = $result->fetch_assoc()) {
    $inventoryData[] = $row;
}

echo json_encode($inventoryData);

// Close the database connection
$conn->close();
?>