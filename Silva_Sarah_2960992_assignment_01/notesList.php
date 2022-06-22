<!--
Name: Sarah Narayamy Tavares Silva
Student Number: 2960992
-->
<!--
Notes list page 
-->
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Notes List</title>
		<link rel="stylesheet" href="stylesheet.css" />
	</head>
	<body>
		<div id="container">
		<h1>Notes List</h1>
		
		<?php
			
			foreach (glob("*.txt") as $fileTitle):
				$title = substr($fileTitle, 0, -4);
                echo "<h1>$fileTitle</h1><br/>" .
                "<ul><li><a href='notesDetails.php?title = $title'>Details</a></li><br/>
                <li><a href='editNote.php?title=$title'>Edit</a></li><br/>
                <li><a href='delete.php?title=$title'>Delete</a></li><br/></ul>";
				echo "<br/><br/>";
            endforeach;
		?>
		
	</body>
</html>
