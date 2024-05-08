<?php
include("./Config.php");

session_start();

// Check if the 'stallname' session variable is set
if (isset($_SESSION['stallname'])) {
    $loggedInStallName = $_SESSION['stallname'];

    // SQL to fetch inventory data for the logged-in user's stallname
    $sql = "SELECT * FROM inventory WHERE stallname =?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("s", $loggedInStallName);

    $stmt->execute();

    $result = $stmt->get_result();

    $inventoryData = array();

    while($row = $result->fetch_assoc()) {
        $inventoryData[] = $row;
    }

    echo json_encode($inventoryData);

    $stmt->close();
    $conn->close();
} else {
    // If 'stallname' is not set, return an error message
    http_response_code(401); // Unauthorized
    echo json_encode(['error' => 'Unauthorized: Please log in first.']);
}
?>
