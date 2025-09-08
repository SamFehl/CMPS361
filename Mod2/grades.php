<html>
    <head>
        <title>Grades</title>
        <h1>I hope I pass!</h1>
    </head>
</html>

<?php
    $grade = 95;

    if($grade >= 90) {
            echo "Letter grade is A. Great job! <br><br>";
        }elseif($grade >= 80) {
            echo "Letter grade is B. Good work! <br><br>";
        }elseif($grade >= 70) {
            echo "Letter grade is C. Keep trying! <br><br>";
        }elseif($grade < 70) {
            echo "You are failing. Do better :( <br><br>";
        }else {
            echo "Letter grade is unavailable. Try again later. <br><br>";
        }
?>

<a href=hello.php><button>Return</button></a>