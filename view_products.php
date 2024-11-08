<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products</title>
    <style>
        /* General Styling */
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f4f6f8;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #ffffff;
            margin-top: 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #1bbc9d;
            color: #ffffff;
            font-weight: bold;
        }

        td {
            color: #555555;
            border-bottom: 1px solid #e0e0e0;
        }

        /* Action Links */
        a {
            text-decoration: none;
            color: #1bbc9d;
            font-weight: bold;
        }

        a:hover {
            color: #139c7a;
        }

        /* Button Styling */
        .add-button {
            display: inline-block;
            padding: 10px 15px;
            margin-bottom: 15px;
            background-color: #1bbc9d;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        .add-button:hover {
            background-color: #139c7a;
        }

        /* Delete button color change to red */
        .delete-button {
            background-color: #e74c3c; /* Red color for delete */
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }

        /* Hover effect for delete button */
        .delete-button:hover {
            background-color: #c0392b; /* Darker red on hover */
        }
    </style>
</head>
<body>
    <h2>Product Inventory</h2>
    <a href="add_product.php" class="add-button">Add New Product</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Product Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Actions</th>
        </tr>
        <?php
        // Connect to database
        $conn = new mysqli("localhost", "root", "", "inventory_management");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Query to fetch all products
        $sql = "SELECT * FROM products";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["product_name"] . "</td>";
                echo "<td>" . $row["description"] . "</td>";
                echo "<td>" . $row["price"] . "</td>";
                echo "<td>" . $row["quantity"] . "</td>";
                echo "<td><a href='edit_product.php?id=" . $row["id"] . "'>Edit</a> | <a href='delete_product.php?id=" . $row["id"] . "' class='delete-button' onclick=\"return confirm('Are you sure you want to delete this item?');\">Delete</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No products found</td></tr>";
        }

        // Close connection
        $conn->close();
        ?>
    </table>
</body>
</html>
