<!DOCTYPE html>
<html>

<head>
    <title>Tailored Tails - Products</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <h1>Our Products</h1>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tailoredtailsusers";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // Retrieve all products from the database
    $query = "SELECT * FROM products";
    $result = $conn->query($query);
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='product'>";
            echo "<img src='" . $row['image_url'] . "' alt='" . $row['name'] . "'>";
            echo "<h2>" . $row['name'] . "</h2>";
            echo "<p>" . $row['description'] . "</p>";
            echo "<p>Price: $" . $row['price'] . "</p>";
            echo "<form action='cart.php' method='POST'>";
            echo "<input type='hidden' name='product_id' value='" . $row['product_id'] . "'>";
            echo "<input type='submit' name='add_to_cart' value='Add to Cart'>";
            echo "</form>";
            echo "</div>";
        }
    } else {
        echo "No products found.";
    }
    $conn->close();
    ?>
</body>

</html>