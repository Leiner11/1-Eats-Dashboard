<?php
session_start();

include("Config.php");

$loggedInStallName = $_SESSION['stallname'];

// Query to get product names for the logged-in user's stall
$sql = "SELECT name FROM products WHERE stallname =?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $loggedInStallName); // "s" indicates the parameter type is string

$stmt->execute();
$result = $stmt->get_result();

// Start the select tag
echo '<select id="category" name="category" required>';

// Add default option
echo '<option value="">Choose a food</option>';

// Loop through the result set and add options for each product
while ($row = $result->fetch_assoc()) {
    echo '<option value="'. htmlspecialchars($row['name']). '">'. htmlspecialchars($row['name']). '</option>';
}

echo '</select>';

$stmt->close();
$conn->close();
?>
