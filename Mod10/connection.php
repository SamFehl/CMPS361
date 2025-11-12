<?php 
    //Database Configuration
    $host = 'localhost';
    $db = 'stats';
    $db_user = 'postgres'; 
    $db_pass = '@gL21384'; 
    $port = '5432'; 

    try {
        $dsn = "pgsql:host=$host;port=$port;dbname=$db";
        $pdo = new PDO($dsn, $db_user, $db_pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e){
        echo 'Connection Failed: ' . $e->getMessage();
    }
?>