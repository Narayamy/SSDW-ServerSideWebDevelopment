<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Same page</title>
	<link rel="stylesheet" href="css/style.css" />
</head>
 <body>

<h1> Same page </h1>
<h2> Form and form handling on same page </h2>
<form action="1_simple.php" method="post">
  <label for="num">Enter a number between 1 and 10:</label><br />
 <input type="number"  id="num" name="num"  /><br/><br/>
 We will print a message that number of times<br/>
<input type="submit" value="Submit" > <br/><br/>
 </form>

 <?php
 $num  = 0; 

function validate_input($data)
 {
	 $data = trim($data);
	 $data = htmlspecialchars($data);
	 return $data;
 }


if ($_SERVER["REQUEST_METHOD"] == "POST") 
{ // only called when the form has been submitted by post
	// so this code doesnt run when the form first loads
	if 	(empty($_POST["num"])) 
	{
		Echo "Please enter a number";
	}
	else { 
		if (is_numeric($_POST["num"])) 
		{
			$num =  validate_input($_POST["num"]);		
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
 }
?>

 </body>
 </html> 





