<?php
include("Config.php");

// Query to get product names
$sql = "SELECT name FROM products";
$result = $conn->query($sql);

// Start the select tag
echo '<select id="category" name="category" required>';

// Add default option
echo '<option value="">Choose a food</option>';

// Loop through the result set and add options for each product
while ($row = $result->fetch_assoc()) {
    echo '<option value="'. htmlspecialchars($row['name']). '">'. htmlspecialchars($row['name']). '</option>';
}

echo '</select>';

$conn->close();
?>
