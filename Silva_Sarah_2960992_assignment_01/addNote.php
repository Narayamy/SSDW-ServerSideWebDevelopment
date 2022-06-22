<!--
Name: Sarah Narayamy Tavares Silva
Student Number: 2960992
-->
<!--
Add note page 
-->

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>AddNote</title>
		<link rel="stylesheet" href="style/main.css" />
	</head>
	<body>
		<div id = "page">
			<h1>Add note</h1>

			<?php
				$title = "";
				$details = "";
				$error = "";
				$errors = array();
				$feedback = "";
						
				function validate_input($data){
					// strip unnecessary characters
					$data = trim($data);
					// converting possible special characters to HTML entities
					$data = htmlspecialchars($data);
					return $data;
				}

				// runs only when the form is submited
				// by clicking the submit button
				if($_SERVER["REQUEST_METHOD"] == "POST"):
					// Server side validation
					if(empty($_POST["title"])):
						array_push($errors, "Please enter a valid title.");
					else:
						$title = validate_input($_POST["title"]);
						$title = str_replace(" ", "_", $title);
					endif;
					// Server side validation
					if(empty($_POST["details"])):
						array_push($errors, "Please enter the details of your note.");
					else:
						$details = validate_input($_POST["details"]);
					endif;

					$fileTitle = $title.".txt";
					$file = fopen($fileTitle, "a+") or die("Unable to open file");
					fwrite($file, $details . "\r\n");
					fclose($file);

					foreach($errors as $i):
						$error = $error . $i . "<br/>";
					endforeach;
		
					$feedback = "File saved as: $fileTitle";
				endif;
			?>
			<?= $error;?><br />
			<form action = "addNote.php" method = "post">
				<label for = "title">Name:</label><br/><input type = "text" name = "title" id = "title" required value = "<?= $title; ?>"><br/><br/>
				<label for = "details">Details:</label><br/><textarea name = "details" id = "details" required rows = "20" cols = "50"><?= $details;?></textarea><br/><br/>
				<input type = "submit" name = "submit" value = "Submit" > <br/><br/>
			</form>
		
			<?= $feedback;?>
		
			<h3><a href="index.php" target="blank">Back to Home Page</a></h3>
		</div>
		<?php include_once 'footer.html'; ?>	
	</body>
</html>