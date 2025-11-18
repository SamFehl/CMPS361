<?php 

function logActivity($userId, $activityType, $activityDescription){
    //Create a DB connection
    $host = 'localhost';
    $db = 'stats';
    $db_user = 'postgres'; 
    $db_pass = '@gL21384'; 
    $port = '5432'; 

    $conn = pg_connect("host=$host port=$port dbname=$db user=$db_user password=$db_pass");

    //Validate the Connection Works
    if(!$conn){
        die("Connection failed: " . pg_last_error());
    }

    //Capture IP Addresses
    $ipAddress = $_SERVER['REMOTE_ADDR'];
    $userAgent = $_SERVER['HTTP_USER_AGENT'];

    //Add tracking information to the DB
    $sql = "INSERT INTO user_activity_logging(user_id,activity_type,activity_description,ip_address,user_agent) VALUES ($1, $2, $3, $4, $5)";

    //Execute the SQL for the INSERT into table
    $result = pg_query_params($conn, $sql, array($userId, $activityType, $activityDescription, $ipAddress, $userAgent));

    if(!$result){
        echo "Error in query execution " . pg_last_error($conn);
    } else {
        echo "Activity logged successfully";
    }

    //Close the connection to the DB
    pg_close($conn);

}

?>