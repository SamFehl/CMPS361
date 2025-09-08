<html>
    <head>
        <title>Challenge</title>    
    </head>
    <body>
        <h1>Is your number odd or even?</h1>
        <form method="post">
            Enter a number: <input type="text" name="number"><br>
            <input type="submit" value="submit">
        </form>
        
    </body>
</html>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $num = $_POST["number"];
        if ($num % 2 == 0) {
            echo "The number $num is even.";
        }else{
            echo "The number $num is odd.";
        }
    }
?>