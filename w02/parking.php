<!--
Name: Sarah Narayamy Tavares Silva
Student Number: 2960992
-->
<!--
Create a PHP Script called parking.php to calculate the cost of parking based on the following information:
•Rates as follows: 
◦3 hours or less = €1.50
◦After 3 hours cost = €0.50 per hour (or part thereof)
◦Maximum cost in 24 hour period = €10
Use a function which has one argument (No of hours).
Call the function three times with various hours and display the result to screen each time.
-->

<!DOCTYPE html>
<html>
<head>
<title>Parking Calculator</title>
<meta charset="UTF-8"/>
</head>
<body>
<h1>Parking Calculator</h1>


<?php
	
	function calculateParking($noOfHours){
		 $price;
		if($noOfHours<=3){
			echo "The price is: €1.50! <br/>";
		}
		elseif($noOfHours>3 && $noOfHours<24){
			echo "The price is: €" . $price=$noOfHours*0.50 . "!<br/>";
		}
		elseif($noOfHours=24){
			echo "The price is: €10! <br/>";
		}
	}

		calculateParking(2);
		calculateParking(3);
		calculateParking(7);
		calculateParking(24);


?>

</body>
</html>