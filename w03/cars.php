<!--
Name: Sarah Narayamy Tavares Silva
Student Number: 2960992
-->
<!--
Create a webpage called cars.php using html and PHP that:
•	Creates an array called cars and populates the array with the following cars
o	Juke
o	Mondeo
o	MX5
o	Micra
o	Fiesta

•	Sort the cars in alphabetical order using a function.  Display to the screen with an
	appropriate heading. Each car should appear on a line of its own.
•	Sort the cars in reverse alphabetical order using a function.  Display to the screen with an
	appropriate heading. The cars should appear in an unordered list.
•	Use functions to add the car “Auris” to the end of the array and add the car “Picasso” to the
	beginning of the array.  Print the array to the screen with an appropriate heading.

-->

<!DOCTYPE html>
<html>
<head>
<title>Cars</title>
<meta charset="UTF-8"/>
</head>
<body>
<h1>Cars</h1>


<?php
	
	$cars = array("Juke", "Mondeo", "MX5", "Micra", "Fiesta");
	function sortAlphabetical($cars){
		echo "<h2>Cars in Alphabetical order:</h2><br/>";
		sort($cars);
		foreach($cars as $c){
		echo $c . "<br/>";
		}	
	}
	
	sortAlphabetical($cars);
	
	function sortReverse($cars){
		echo "<h2>Cars in reverse Alphabetical order:</h2><br/>";
		rsort($cars);
		foreach($cars as $c){
		echo "<ul><li> $c</li></ul>";
		}	
	}
	
	sortReverse($cars);
	
	function addCars($cars){
		echo "<h2>Adding cars to the array</h2><br/>";
		$n = array_push($cars, "Auris");
		$f = array_unshift($cars, "Picasso");
		foreach($cars as $c){
		echo $c . "<br/>";
		}	
	}
	
	addCars($cars);
	
?>

</body>
</html>	