<!--
Name: Sarah Narayamy Tavares Silva
Student Number: 2960992
-->
<!--
Create a webpage which welcomes the user by name. Save it as Q1_welcome.php.
Your page should have a form with a textbox which prompts for the user’s name and a submit. 
-->

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Q01 - Welcome</title>
	<link rel="stylesheet" href="css/style.css" />
</head>
 <body>

<h1>Welcome page</h1>

<?php
 $name  = "";
 $nameError = "";
 $feedback = "";
 function validate_name($data){
	 $data = trim($data);
	 $data = htmlspecialchars($data);
	 return $data;
 }


if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// called when the user does not insert his name
	// and clicks the submit button
	if 	(empty($_POST["name"])) {
		$nameError= "Please enter your name";
	}
	else {
		$name = validate_name($_POST["name"]);
		$feedback = "Welcome " . $name ;
	}
 }
?>

<form action="Q1_welcome.php" method="post">
Name: <br/><input type="text" name="name" id="name" /> <?php echo $nameError;?><br/><br/>
<input type="submit" value="Submit" > <br/><br/>
</form>
<?php echo $feedback;?>
 
  

 </body>
 </html>