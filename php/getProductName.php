<?php
session_start();

include("Config.php");

$loggedInStallName = $_SESSION['stallname'];

// Query to get product names and IDs for the logged-in user's stall
$sql = "SELECT id, name, price FROM products WHERE stallname =?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $loggedInStallName); // "s" indicates the parameter type is string

$stmt->execute();
$result = $stmt->get_result();

// Start the select tag
echo '<select id="category" name="category" required onchange="calculateTotal()">';
// Add default option
echo '<option value="">Choose a food</option>';

// Loop through the result set and add options for each product
while ($row = $result->fetch_assoc()) {
    // Generate a unique ID for each hidden input field
    $hiddenInputId = "price_". $row['id'];
    echo '<option value="'. htmlspecialchars($row['id']). '">'. htmlspecialchars($row['name']). '</option>';
    echo '<input type="hidden" id="'. $hiddenInputId. '" value="'. htmlspecialchars($row['price']). '">';
}

echo '</select>';

$stmt->close();
$conn->close();
?>
