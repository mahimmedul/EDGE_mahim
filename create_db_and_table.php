<?php
// Database connection variables
$servername = "localhost";
$username = "root"; // Default username for localhost
$password = ""; // Default password for localhost, leave blank if not set

//  Connect to the MySQL server
$conn = new mysqli($servername, $username, $password);

// Check if the connection works
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//  Create a new database
$sql = "CREATE DATABASE IF NOT EXISTS inventory_management";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully.<br>";
} else {
    echo "Error creating database: " . $conn->error;
}

//  Use the new database
$conn->select_db("inventory_management");

//  Create the 'products' table
$sql = "CREATE TABLE IF NOT EXISTS products (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    quantity INT NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'products' created successfully.";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
