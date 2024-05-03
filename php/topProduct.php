<?php
include "./Config.php";

$sql = "SELECT p.stall_id, p.name, SUM(o.quantity) AS total_sales
        FROM products p
        JOIN orders o ON p.id = o.product_id
        GROUP BY p.stall_id, p.name
        ORDER BY total_sales DESC
        LIMIT 5";

$result = mysqli_query($conn, $sql);

$data = []; // Initialize an empty array to hold the data

// Check if the query was successful
if (mysqli_num_rows($result) > 0) {
    
    // Output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $data[] = [
            "name" => $row["name"], // Product name
            "count" => $row["total_sales"] // Total sales
        ];
    }
} else {
    $data[] = ["name" => "No results", "count" => 0]; // Add a placeholder if no results
}

// Set the content type to JSON
header('Content-Type: application/json');

// Convert the data array to JSON format and echo it
echo json_encode($data);
?>
