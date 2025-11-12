<?php
session_start();

//Check if user is logged on
if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="./style1.css">
        <title>Welcome</title>
    </head>
    <body>
        <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
        <div class="nav-buttons">
            <a href="vehicles.php">View Vehicles</a>
            <a href="addvehicles.php">Add Vehicles</a>
            <a href="logout.php">Logout</a>
        </div>
    </body>
</html>