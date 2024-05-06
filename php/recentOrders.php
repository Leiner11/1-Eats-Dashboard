<?php
$sql = "SELECT order_id, customer_name, order_date, status FROM orders ORDER BY order_date DESC";
$result = mysqli_query($conn, $sql);

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

mysqli_close($conn);
?>