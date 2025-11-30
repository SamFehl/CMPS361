<?php
// Start the session
session_start();

require_once __DIR__ . '/bootstrap.php';

//Check if user is logged on
if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Unset all session variables
$_SESSION = array();

// If it's desired to kill the session completely, also delete the session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finally, destroy the session
session_destroy();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Stats App Logout</title>
        <link rel="stylesheet" href="./style1.css">
    </head>
    <body>
        <h2>Successfully Logged Out!</h2>

        <form action="./authentication.php" method="post">
            <label for="username">Username: </label>
            <input type="text" name="username" required><br><br>
            <label for="password">Password: </label>
            <input type="password" name="password" required><br><br>
            <button type="submit">Login</button>
        </form>
    </body>
    
</html>
