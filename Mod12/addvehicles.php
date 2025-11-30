<?php
//Setup
session_start();
//Check if user is logged on
if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'connection.php';
require_once __DIR__ . '/bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $manufacturer = $_POST['manufacturer'];
    $vehiclename = $_POST['vehiclename'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $model_year = $_POST['model_year'];

    $query = "INSERT INTO vehicles (manufacturer, vehiclename, description, price, model_year)
              VALUES (:manufacturer, :vehiclename, :description, :price, :model_year)";
    
    // Prepare the statement BEFORE executing
    $stmt = $pdo->prepare($query);

    $stmt->execute([
        'manufacturer' => $manufacturer,
        'vehiclename' => $vehiclename,
        'description' => $description,
        'price' => $price,
        'model_year' => $model_year
    ]);

    echo "Vehicle added successfully!";
}
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="./style1.css">
        <title>Add Vehicle</title>
    </head>
    <body>
        <h2>Add Vehicle</h2>

        <form method="post">
            <label for="manufacturer">Manufacturer: </label>
            <input type="text" name="manufacturer" required><br><br>
            <label for="vehiclename">Vehicle Name: </label>
            <input type="text" name="vehiclename" required><br><br>
            <label for="Description">Description: </label>
            <input type="text" name="description" required><br><br>
            <label for="price">Price: </label>
            <input type="number" name="price" required><br><br>
            <label for="model_year">Model Year: </label>
            <input type="number" name="model_year" required><br><br>
            <button type="submit">Submit</button>
        </form>
        <div class="nav-buttons">
            <a href="vehicles.php">View Vehicles</a>
            <a href="addvehicles.php">Add Vehicles</a>
            <a href="logout.php">Logout</a>
        </div>
    </body>
    
</html>