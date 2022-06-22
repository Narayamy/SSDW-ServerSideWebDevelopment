<!--
Name: Sarah Narayamy Tavares Silva
Student Number: 2960992
-->
<!--
Create a web based temperature converter.
-->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Different pages</title>
	<link rel="stylesheet" href="css/style.css" />
</head>
 <body>

<h1>Different pages Results </h1>
<?php
$num  = 0;

function validate_input($data)
{
 $data = trim($data);
 $data = htmlspecialchars($data);
 return $data;
}

// dont need if ($_SERVER["REQUEST_METHOD"] == "GET"	
if 	(empty($_GET["num"])) 
{
	Echo "Please enter a number";
}
else { 
	if (is_numeric($_GET["num"])) 
	{
		$num =  validate_input($_GET["num"]);			
	}
	else {
		echo "Please enter a valid number";
		$num = 0;
	}
}
if ($num > 10)
{
	$num = 10;
}
for($x = 0; $x < $num; $x++) {
	echo "hello <br>" ;
}	

?>

 </body>
 </html> 
