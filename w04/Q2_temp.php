<!--
Name: Sarah Narayamy Tavares Silva
Student Number: 2960992
-->
<!--
Create a form on q2_temp.html which has a text box which takes in a
temperature in Celsius and a submit button/input.
-->

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Temperature Converter</title>
</head>
 <body>

<h1>Celsius to Farenheit Converter </h1>
<?php
$num  = 0;

function validate_input($data){
	$data = trim($data);
	$data = htmlspecialchars($data);
	return $data;
}
function cToF($num){
	$farenheit = $num*1.8+32.00;
	return $farenheit;
}

// dont need if ($_SERVER["REQUEST_METHOD"] == "GET"	
if 	(empty($_GET["num"])){
	Echo "Please enter a number";
}
else { 
	if (is_numeric($_GET["num"])){
		$num =  validate_input($_GET["num"]);
		$f = cToF($num);
		Echo $f." farenheit";
		
	}
	else {
		echo "Please enter a valid number";
		$num = 0;
	}
}

?>

 </body>
 </html> 

