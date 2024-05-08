<?php
include("./Config.php");

session_start();

// Check if the 'stallname' session variable is set
if (isset($_SESSION['stallname'])) {
    $loggedInStallName = $_SESSION['stallname'];

    // total sales for the last 24 hours for the logged-in user's stallname
    $sql = "SELECT SUM(amount) AS total_sales FROM sales WHERE order_date >= NOW() - INTERVAL 24 HOUR AND stallname =?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("s", $loggedInStallName);

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            $total_sales = $row["total_sales"];
        }
    } else {
        echo "No sales found in the last 24 hours for this stall.";
    }

    $stmt->close();
    $conn->close();

    // Return the total sales as JSON
    header('Content-Type: application/json'); // Set the correct content type
    echo json_encode(array("total_sales" => $total_sales));
} else {
    // If 'stallname' is not set, return an error message
    http_response_code(401); // Unauthorized
    echo json_encode(['error' => 'Unauthorized: Please log in first.']);
}
?>
