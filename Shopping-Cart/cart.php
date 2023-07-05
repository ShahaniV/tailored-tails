<!DOCTYPE html>
<html>
<head>
    <title>Tailored Tails - Cart</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Shopping Cart</h1>
    <?php
    // Check if product is added to the cart
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $productId = $_POST["product_id"];
        // Add product to cart logic goes here
        // You can store the product details in session or database
        // and retrieve the cart items to display here
    }
    // Display cart items and total
    echo "<h2>Cart Items</h2>";
    // Display the cart items retrieved from session or database
    // using PHP loops and HTML markup
    // Example: echo "<p>Product Name: $productName, Price: $price</p>";
    echo "<h2>Total: $0.00</h2>"; // Calculate and display the total
    ?>
    <a href="products.php">Continue Shopping</a>
    <a href="checkout.php">Proceed to Checkout</a>
</body>
</html>
