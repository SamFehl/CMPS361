<!-- Form Submission -->
<html>
    <head>
        <title>Form Submission</title>
    <body>
        <form method="post">
            Enter your name: <input type="text" name="username">
            <input type="submit" value="submit">
        </form>
    </body>
    </head>
</html>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $user = $_POST["username"];
        echo "Hello, $user!";
    }
?>
