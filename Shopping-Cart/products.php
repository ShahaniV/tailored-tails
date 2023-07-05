<!DOCTYPE html>
<html>
<head>
    <title>Tailored Tails - Products</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Our Products</h1>
    <div class="product">
        <img src="product1.jpg" alt="Product 1">
        <h2>Product 1</h2>
        <p>Description of Product 1.</p>
        <p>Price: $19.99</p>
        <form action="cart.php" method="POST">
            <input type="hidden" name="product_id" value="1">
            <input type="submit" value="Add to Cart">
        </form>
    </div>
    <!-- Add more product listings as needed -->
</body>
</html>
