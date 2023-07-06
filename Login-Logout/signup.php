<?php
// Establish the database connection
$servername = "localhost";
$username = "root";
$password = ""; // Assuming the password is empty
$dbname = "tailoredtailsusers";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process the signup form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $contactNumber = $_POST["contact_number"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert the user details into the database
    $stmt = $conn->prepare("INSERT INTO users (email, contact_number, username, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $email, $contactNumber, $username, $hashedPassword);
    $stmt->execute();

    // Close the database connection
    $stmt->close();
    $conn->close();

    // Delay the redirection for 2 seconds
    sleep(2);

    // Redirect back to the index.html page
    header("Location: http://localhost/AppDevGalura/tailored-tails/Login-Logout/index.html");
    exit();
}
?>
