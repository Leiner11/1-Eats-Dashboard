<?php
// Database Configuration
define('host', 'localhost'); 
define('username', 'admin_1eats'); 
define('password', 'admin_1eatsat1skul'); 
define('dbname', 'users_dashboard'); 

// Create a new database connection
$conn = new mysqli(host, username, password, dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}