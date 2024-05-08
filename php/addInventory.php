<?php
include("./Config.php");
session_start();

$stallname = $_SESSION['stallname']?? 'Guest';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs
    $foodName = mysqli_real_escape_string($conn, $_POST['foodName']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $price = mysqli_real_escape_string($conn, $_POST['Price']);
    $inventory = mysqli_real_escape_string($conn, $_POST['Inventory']);

    $sql = "INSERT INTO inventory (stallname, product_name, stock_status, price, inventory_status) VALUES (?,?,?,?,?)";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "sssss", $stallname, $foodName, $category, $price, $inventory);

    if (mysqli_stmt_execute($stmt)) {
        echo "New record created successfully";
        header("Location:../Dashboard/inventory.html");
    } else {
        echo "Error: ". $sql. "<br>". mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>
