<!DOCTYPE html>
<!-- This example shows errors beside the textboxes and other elements -->
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Forms</title>
	<link rel="stylesheet" href="css/style.css" />
</head>
 <body>

<h1>Error beside textbox</h1>
<p>Errors are displayed beside appropriate form element</p>

<?php
 $num  = 0;
 $numError = "";
 $feedback = "";

/*function validate_input($data)
 {
	 $data = trim($data);
	 $data = htmlspecialchars($data);
	 return $data;
 }*/


if ($_SERVER["REQUEST_METHOD"] == "POST") 
{ // only called when the form has been submitted
	// so this code doesnt run when the form first loads
	if 	(empty($_POST["num"])) 
	{
		$numError= "Please enter a number";
	}
	else { 
		if (is_numeric($_POST["num"])) 
		{
			$num =  validate_input($_POST["num"]);
			for($x = 0; $x < $num; $x++) {
				 $feedback = $feedback . "hello <br>" ;
			}
		}
		else {
			$numError = "Please enter a valid number";
		}
	}
 }
?>
 <form action="2_ErrorBesideTextbox.php" method="post">
 <label for="num">Enter a number between 1 and 10:</label><br />
 <input type="text" name="num" id="num" />  <span class="error">* <?php echo $numError;?></span><br/><br/>
 We will print a message that number of times<br/>
<input type="submit" value="Submit" > <br/><br/>
 </form>
 <?php echo $feedback;?>
  

 </body>
 </html> 





