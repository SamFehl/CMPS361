<?php 
    //Authentication Credentials
    $host = "localhost";
    $port = "5433";
    $dbname = "teams";
    $user = "postgres";
    $password = "grapes";

    //Connection String
    $dsn = "pgsql:host=$host;dbname=$dbname";


    try{
        //starts session
        $instance = new PDO($dsn,$user,$password);
        
        //Set an error alert
        $instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Echo Messages
        echo "Successfully Connected to the Database!";
    } catch (PDOException $e) {
        echo "Connection Failed: " . $e->getMessage();
    }
?>