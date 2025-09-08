<?php
    //var car = "toyota";
    $vehicle = "toyota";
    $ageOfVehicle = 7;
    $costOfVehicle = 23456.99;
    $makeOfVehicle = "Tundra";

    echo "My vehicle that I own is a $vehicle<br>";

    //Density of a Liquid
    $startingGravity = 1.110;
    $finalGravity = 0.99;
    
        //Conditional Statement
        if($finalGravity <= 0.99) {
            echo "Fermentation is completed. <br>";
        }elseif($finalGravity >= 1.020) {
            echo "Fermentation is not completed. <br>";
        }else {
            echo "We need to add a Nutrient to push the fermentation. <br>";
        }
        
        for($i = 1; $i <= 20; $i++){
            echo "The loop starts here: $i <br>";
        }

?>

<html>
    <head>
        <title>Sandbox Class</title>
        <h1>Fermentation Status</h1>
    </head>
</html>