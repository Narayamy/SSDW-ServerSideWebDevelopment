<!DOCTYPE html>
<!-- This page shows you how to make form variables such as textboxes sticky
	ie they remember what the user types in  -->
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Sticky form</title>
</head>
 <body>
<h1> Sticky form </h1>
<p>In this example the form will remember what you typed in and displays it in the textbox, textarea and checkbox</p>
<?php
$name = $comment = $gender= "";
 $error_msg= $feedback = "";
 $errors = array();

 function prepare_input($data)
 {
	 $data = trim($data);
	 $data = htmlspecialchars($data);
	 return $data;
 }
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if 	(empty($_POST["name"])) 
	{
		array_push($errors, "Please enter a name");
	}
	else { 
		$name =  prepare_input($_POST["name"]);		
	}
	
	if 	(empty($_POST["comment"])) 
	{
		array_push($errors, "Please enter a comment");
	}
	else { 
		$comment =  prepare_input($_POST["comment"]);		
	}
   
	if 	(empty($_POST["gender"])) 
	{
		array_push($errors, "Please enter a gender");
	}
	else { 
		$gender =  prepare_input($_POST["gender"]);		
	}
	foreach($errors as $error){
			$error_msg = $error_msg  . $error . "<br />";
	}
	
	$feedback = "The following details have been recorded: <br/>Name=$name<br/>Comment=$comment<br/>Gender=$gender ";
	
}
?>

 <?php echo $error_msg;?><br />
<form method="post" action="3_sticky.php"> 
   <label for="name">Name:</label> <input type="text" id="name" name="name" value="<?php echo $name;?>">
   <br><br>
   <label for="comment">Comment:</label> <textarea id="comment" name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
   <br><br>
   Gender:
  <input type="radio" name="gender" id="female" <?php if ($gender=="female") echo "checked";?>  value="female"> <label for="female">Female </label>
   <input type="radio" name="gender" id="male" <?php if ($gender=="male") echo "checked";?>  value="male"> 
   <label for="male">Male </label>
   <br><br>
   <input type="submit" name="submit" value="Submit"> 
</form>
<?php echo $feedback;?>
 </body>
 </html>