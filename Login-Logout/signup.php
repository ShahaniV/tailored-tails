<?php
// Establish the database connection
$servername = "localhost";
$username = "your_username";
$password = "your_password";
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
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Insert the user details into the database
    $sql = "INSERT INTO users (email, contact_numbers, username, passwords) VALUES ('$email', '$contactNumber', '$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Signup successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
