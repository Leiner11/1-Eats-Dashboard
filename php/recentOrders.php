<?php

// Check if the 'stallname' session variable is set
if (isset($_SESSION['stallname'])) {
    $loggedInStallName = $_SESSION['stallname'];

    // Calculate the date and time 24 hours ago
    $date24HoursAgo = date('Y-m-d H:i:s', strtotime('-24 hours'));

    $sql = "SELECT order_id, customer_name, order_date, status FROM orders WHERE stallname =? AND order_date >=? ORDER BY order_date DESC";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "ss", $loggedInStallName, $date24HoursAgo);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>". htmlspecialchars($row["order_id"]). "</td>";
            echo "<td>". htmlspecialchars($row["customer_name"]). "</td>";
            echo "<td>". htmlspecialchars($row["order_date"]). "</td>";
            echo "<td>". htmlspecialchars($row["status"]). "</td>";
            echo "<td><a href='#'>View Details</a></td>";
            echo "</tr>";
        }
    } else {
        echo "No records found";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} 
?>