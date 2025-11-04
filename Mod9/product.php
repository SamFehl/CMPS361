<?php 
include 'connection.php';
$query = "SELECT * from products";
$stat = $pdo->query($query);
$product = $stat->fetchAll(PDO::FETCH_ASSOC);

error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<html>
    <head>
        <title>Products</title>
    </head>
    <body>
        <h1>Products</h1>
        <table>
            <thread>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Stock Level</th>

                </tr>
            </thread>
            <tbody>
                <?php foreach($product as $product): ?>
                    <tr>
                        <td><?= htmlspecialchars($product['name']) ?></td>
                        <td><?= htmlspecialchars($product['description']) ?></td>
                        <td><?= htmlspecialchars($product['price']) ?></td>
                        <td><?= htmlspecialchars($product['stock_level']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </body>
</html>