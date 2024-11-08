<?php
$conn = new mysqli("localhost", "root", "", "inventory_management");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $product_name = $_POST["product_name"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];

    $sql = "UPDATE products SET product_name='$product_name', description='$description', price='$price', quantity='$quantity' WHERE id='$id'";
    $conn->query($sql);

    header("Location: view_products.php");
    exit();
} else {
    $id = $_GET["id"];
    $result = $conn->query("SELECT * FROM products WHERE id='$id'");
    $product = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <style>
        /* General Styling */
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
            text-align: center;
        }

        /* Form Styling */
        label {
            display: block;
            margin-bottom: 8px;
            color: #555555;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        textarea {
            height: 100px;
            resize: vertical;
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

        /* Back Link */
        .back-link {
            display: inline-block;
            margin-top: 10px;
            text-decoration: none;
            color: #1bbc9d;
            font-weight: bold;
            text-align: center;
            width: 100%;
        }

        .back-link:hover {
            color: #139c7a;
        }

        /* Success Message Styling */
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
        <h2>Edit Product</h2>
        <form action="edit_product.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">

            <label for="product_name">Product Name</label>
            <input type="text" name="product_name" value="<?php echo $product['product_name']; ?>" required>

            <label for="description">Description</label>
            <textarea name="description" required><?php echo $product['description']; ?></textarea>

            <label for="price">Price</label>
            <input type="number" name="price" step="0.01" value="<?php echo $product['price']; ?>" required>

            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" value="<?php echo $product['quantity']; ?>" required>

            <input type="submit" value="Update Product">
        </form>

        <a href="view_products.php" class="back-link">Back to Product List</a>
    </div>
</body>
</html>
