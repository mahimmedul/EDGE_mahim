<?php
if (isset($_GET['id'])) {
    $conn = new mysqli("localhost", "root", "", "inventory_management");

    $id = $_GET['id'];
    $conn->query("DELETE FROM products WHERE id='$id'");
    $conn->close();
}

header("Location: view_products.php");
exit();
?>
