<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <style>
        
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f4f6f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Form Container */
        .form-container {
            width: 100%;
            max-width: 500px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .form-container h2 {
            margin-top: 0;
            color: #333333;
        }

        /* Form  */
        label {
            display: block;
            margin-bottom: 8px;
            color: #555555;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #1bbc9d;
            color: #ffffff;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #139c7a;
        }

        /*  Link */
        .back-link {
            display: inline-block;
            margin-top: 10px;
            text-decoration: none;
            color: #1bbc9d;
            font-weight: bold;
        }

        .back-link:hover {
            color: #139c7a;
        }

        /* Success Message  */
        .success-message {
            display: none;
            margin-bottom: 15px;
            color: green;
            font-weight: bold;
            font-size: 1em;
        }
    </style>
</head>
<body>

<div class="form-container">
    <div id="success-message" class="success-message">New product added successfully!</div>
    <h2>Add New Product</h2>
    <form action="add_product.php" method="POST">
        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name" required>

        <label for="description">Description:</label>
        <input type="text" id="description" name="description" required>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step="0.01" required>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" required>

        <input type="submit" value="Add Product">
    </form>
    <a href="view_products.php" class="back-link">Back to Products</a>
</div>

<?php
// Process form data on form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to database
    $conn = new mysqli("localhost", "root", "", "inventory_management");

    //  connection dekhbe
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // form data pabo and prepare the SQL statement
    $product_name = $conn->real_escape_string($_POST["product_name"]);
    $description = $conn->real_escape_string($_POST["description"]);
    $price = $conn->real_escape_string($_POST["price"]);
    $quantity = $conn->real_escape_string($_POST["quantity"]);

    $sql = "INSERT INTO products (product_name, description, price, quantity) 
            VALUES ('$product_name', '$description', '$price', '$quantity')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
            // Display success message
            document.getElementById('success-message').style.display = 'block';
            
            // Hide after 2 seconds
            setTimeout(function() {
                document.getElementById('success-message').style.display = 'none';
            }, 2000);
        </script>";
    } else {
        echo "<p style='color: red; font-weight: bold;'>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }

    // Close connection
    $conn->close();
}
?>

</body>
</html>
