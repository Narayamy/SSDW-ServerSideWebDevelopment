<!--
Name: Sarah Narayamy Tavares Silva
Student Number: 2960992
-->
<!--
Index page
-->
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Notes List</title>
		<link rel="stylesheet" href="style/main.css" />
	</head>
	<body>
		<div id = "page">
			<h1>Notes List</h1>
		
			<?php
				foreach (glob("*.txt") as $fileTitle):
					$title = substr($fileTitle, 0, -4);
            	    echo "<h2>$fileTitle</h2>" .
                	"<ul><li><a href='notesDetails.php?title=$title'>Details</a></li>
                	<li><a href='editNote.php?title=$title'>Edit</a></li>
                	<li><a href='deleteNote.php?title=$title'>Delete</a></li></ul>";
					echo "<br/><br/>";
            	endforeach;
			?>
		
			<h3><a href="addNote.php" target="blank">Add a new Note</a></h3>

		</div>
		<?php include_once 'footer.html';?>
	</body>
</html>
