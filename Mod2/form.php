<html>
    <head>
        <title>Form</title>    
    </head>
    <body>
        <h1>Tell me about yourself!</h1>
        <form method="post">
            Enter your name: <input type="text" name="username"><br>
            Enter your age: <input type="text" name="userAge"><br>
            Enter your Social Security Number: <input type="text" name="ssn"><br>
            <input type="submit" value="submit">
        </form>
        
    </body>
</html>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $user = $_POST["username"];
        $age = $_POST["userAge"];
        $ssn = $_POST["ssn"];
        echo "Hello, $user! You are $age years old. You SSN is totally secure...";
    }
?>