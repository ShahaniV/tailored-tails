<?php
session_start();

// MySQL database configuration
$hostname = 'localhost';
$username = 'your_username';
$password = 'your_password';
$database = 'your_database';

// Establish a database connection
$conn = mysqli_connect($hostname, $username, $password, $database);

// Check if the connection was successful
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}

// Sign up functionality
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup'])) {
    $email = $_POST['email'];
    $contactNumber = $_POST['contact_number'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Insert user data into the database
    $sql = "INSERT INTO users (email, contact_number, username, password) VALUES ('$email', '$contactNumber', '$username', '$password')";
    if (mysqli_query($conn, $sql)) {
        echo 'Sign up successful. You can now login.';
    } else {
        echo 'Error: ' . $sql . '<br>' . mysqli_error($conn);
    }
}

// Login functionality
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Retrieve user data from the database
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $_SESSION['username'] = $username;

        if (isset($_POST['remember'])) {
            // Set cookies if "Remember me" is checked
            setcookie('username', $username, time() + (86400 * 30), '/');
            setcookie('password', $password, time() + (86400 * 30), '/');
        } else {
            // Delete cookies if "Remember me" is not checked
            setcookie('username', '', time() - 3600, '/');
            setcookie('password', '', time() - 3600, '/');
        }

        header('Location: home.php');
        exit();
    } else {
        echo 'Invalid username or password.';
    }
}

// Check if cookies are set and populate the saved username
$savedUsername = isset($_COOKIE['username']) ? $_COOKIE['username'] : '';

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login Page</h1>
    
    <form action="login.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" value="<?php echo $savedUsername; ?>" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>
        
        <label for="remember">Remember me:</label>
        <input type="checkbox" name="remember" id="remember"><br><br>
        
        <input type="submit" name="login" value="Login">
    </form>

    <h1>Sign Up Page</h1>
    
    <form action="login.php" method="post">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br><br>
        
        <label for="contact_number">Contact Number:</label>
        <input type="text" name="contact_number" id="contact_number" required><br><br>
        
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>
        
        <input type="submit" name="signup" value="Sign Up">
    </form>
</body>
</html>
