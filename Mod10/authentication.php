<?php

//Start Session
session_start();

//Database Configuration
$host = 'localhost';
$db = 'stats';
$db_user = 'postgres'; //correct
$db_pass = '@gL21384'; //correct
$port = '5432'; //correct

//Create Connection to PostGres
$conn = pg_connect("host=$host port=$port dbname=$db user=$db_user password=$db_pass");

//Validate the Connection Works
if (!$conn){
    die("Connection Failed".pg_last_error());
}

//Get User Account Information
$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';


//SQL Query
$sql = "SELECT * FROM users WHERE username=$1";
$result = pg_query_params($conn, $sql, array($username));

if ($result && pg_num_rows($result) > 0) {
    $userData = pg_fetch_assoc($result);

    if ($userData && isset($userData['password'], $userData['username'])) {
        if (hash_equals($userData['password'], crypt($password, $userData['password']))) {
            $_SESSION['username'] = $userData['username'];
            header("Location: welcome.php");
            exit;
        } else {
            echo "Invalid Password";
        }
    } else {
        echo "User data not found or incomplete.";
    }

    pg_close($conn);
} else {
    echo "Invalid Username or query failed.";
}


?>