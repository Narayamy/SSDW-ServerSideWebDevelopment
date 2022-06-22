<!--
Name: Sarah Narayamy Tavares Silva
Student Number: 2960992
-->
<!--
delete note page 
-->
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Delete Note</title>
		<link rel="stylesheet" href="style/main.css" />
	</head>
	<body>
		<div id = "page">
			<h1>Deleting a Note</h1>
		
			<?php
        	    $fileTitle = "";
        	    $feedback = "";
    
        	    // accessing data from get method
				if ($_SERVER['REQUEST_METHOD'] == 'GET'):
					$title = $_GET["title"];
					$fileTitle = $title.".txt";
					$feedback = "<br/><p> The file: $fileTitle</p> was deleted";
					unlink($fileTitle);	
				endif
			?>
		
			<?= $feedback;?>
		
			<h3><a href="index.php" target="blank">Back to Home Page</a></h3>
		</div>
		<?php include_once 'footer.html'; ?>
	</body>
</html>