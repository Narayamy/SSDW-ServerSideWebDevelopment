<!--
Name: Sarah Narayamy Tavares Silva
Student Number: 2960992
-->
<!--
edit note page 
-->

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Edit Note</title>
		<link rel="stylesheet" href="style/main.css" />
	</head>
	<body>
		<div id = "page">
			<h1>Edit Note</h1>
		
			<?php
    	        $title = "";
        	    $details = "";
        	    $error= "";
        	    $errors = array();
        	    $feedback = "";

				function validate_input($data){
            	    // strip unnecessary characters
            	    $data = trim($data);
            	    // converting possible special characters to HTML entities
					$data = htmlspecialchars($data);
					return $data;
				}
            
           		// accessing data from get method
				if($_SERVER['REQUEST_METHOD'] == 'GET'):
					$title = $_GET["title"];
					$fileTitle = $title.".txt";
					$file = fopen($fileTitle,"r") or die ("Unable to open file!");
					$toRead = fread($file, filesize($fileTitle));
					$details =  htmlspecialchars($toRead);
					fclose($file);
            
            	    // runs only when the form is submited
				    // by clicking the submit button
				elseif($_SERVER['REQUEST_METHOD'] == 'POST'):
            	    // Server side validation
					if(empty($_POST["title"])):
						array_push($errors, "Please enter a title.");
            	    else:
						$title =  validate_input($_POST["title"]);
						$title = str_replace(" ", "_", $title);
					endif;
	
					if(empty($_POST["details"])):
						array_push($errors, "Please enter the details");
                	else:
						$details =  validate_input($_POST["details"]);
					endif;
				
					$fileTitle = $title.".txt";
					$file = fopen($fileTitle, "w+") or die("Unable to open file!");
					fwrite($file, $details);
					fclose($file);
				
					foreach($errors as $i):
						$error = $error  . $i . "<br />";
        	        endforeach;
	
					$feedback = "<br/>File saved as: $fileTitle";
            	endif;
			?>
			<form action = "editNote.php" method = "post">
				<label for = "title">Name:</label><br/><input type = "text" id = "title" name = "title" required value = "<?php echo $title;?>"><br><br>
				<label for = "details">Details:</label><br/><textarea id = "details" name = "details" required rows = "20" cols = "50"><?php echo $details;?></textarea><br>
				<input type = "submit" name = "submit" value = "Submit"> 
			</form>
		
			<?= $feedback;?>
		
			<h3><a href="index.php" target="blank">Back to Home Page</a></h3>
		</div>
		<?php include_once 'footer.html'; ?>
	</body>
</html>