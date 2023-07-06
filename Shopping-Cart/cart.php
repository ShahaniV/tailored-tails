<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tailoredtailsusers";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Handle add to cart
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['add_to_cart'])) {
        $product_id = $_POST["product_id"];

        // Check if the product is already in the cart
        $query = "SELECT * FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id'";
        $result = $conn->query($query);

        if ($result && $result->num_rows > 0) {
            echo "Product already exists in the cart.";
        } else {
            // Add the product to the cart
            $query = "INSERT INTO cart (user_id, product_id) VALUES ('$user_id', '$product_id')";
            if ($conn->query($query) === TRUE) {
                echo "Product added to the cart.";
            } else {
                echo "Error: " . $conn->error;
            }
        }
    }

    // Get the cart items for the user
    $query = "SELECT cart.cart_id, products.name, products.price FROM cart
              INNER JOIN products ON cart.product_id = products.product_id
              WHERE cart.user_id = '$user_id'";
    $result = $conn->query($query);

    if ($result) {
        if ($result->num_rows > 0) {
            // Display the cart items
            echo "<h2>Your Cart</h2>";
            echo "<table>";
            echo "<tr><th>Item</th><th>Price</th></tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>$" . $row['price'] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "Your cart is empty.";
        }
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Please log in to view your cart.";
}

$conn->close();
?>
