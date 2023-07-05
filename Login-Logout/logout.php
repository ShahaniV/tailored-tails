<?php
// Clear the remember me cookie if set
if (isset($_COOKIE["user"])) {
    setcookie("user", "", time() - 3600, "/");
}

// Redirect to the login page
header("Location: index.html");
exit();
?>
