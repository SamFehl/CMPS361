<?php
//Setup
session_start();
//Check if user is logged on
if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

require_once __DIR__ . '/connection.php';
require_once __DIR__ . '/bootstrap.php';

/** @var PDO $pdo */
$query = "SELECT * from vehicles";
$stat = $pdo->query($query);
/** @var PDOStatement $stat */
$vehicle = $stat->fetchAll(PDO::FETCH_ASSOC);

error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<html>
    <head>
        <link rel="stylesheet" href="./style1.css">
        <title>Vehicles</title>
    </head>
    <body>
        <h1>Vehicles</h1>
        <table>
            <thead>
                <tr>
                    <th>Manufacturer</th>
                    <th>Vehicle Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Model Year</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($vehicle as $vehicle): ?>
                    <tr>
                        <td><?= htmlspecialchars($vehicle['manufacturer']) ?></td>
                        <td><?= htmlspecialchars($vehicle['vehiclename']) ?></td>
                        <td><?= htmlspecialchars($vehicle['description']) ?></td>
                        <td><?= htmlspecialchars($vehicle['price']) ?></td>
                        <td><?= htmlspecialchars($vehicle['model_year']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="nav-buttons">
            <a href="vehicles.php">View Vehicles</a>
            <a href="addvehicles.php">Add Vehicles</a>
            <a href="logout.php">Logout</a>
        </div>
    </body>
</html>