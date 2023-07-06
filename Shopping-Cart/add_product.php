<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tailoredtailsusers";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $image_url = $_POST["image_url"];

    // Prepare the statement
    $stmt = $conn->prepare("INSERT INTO products (name, description, price, image_url) VALUES (?, ?, ?, ?)");
    
    // Bind the parameters
    $stmt->bind_param("ssds", $name, $description, $price, $image_url);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to add_product.php
        header("Location: add_product.php");
        exit(); // Make sure to exit after redirect
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
</head>
<body>
    <h2>Add Product</h2>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="name">Product Name:</label>
        <input type="text" name="name" id="name" required><br>

        <label for="description">Description:</label>
        <textarea name="description" id="description" required></textarea><br>

        <label for="price">Price:</label>
        <input type="number" name="price" id="price" step="0.01" required><br>

        <label for="image_url">Image URL:</label>
        <input type="text" name="image_url" id="image_url" required><br>

        <input type="submit" value="Add Product">
    </form>
</body>
</html>
