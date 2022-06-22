<!--
Name: Sarah Narayamy Tavares Silva
Student Number: 2960992
-->
<!--
Notes details page 
-->
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Note detail</title>
		<link rel="stylesheet" href="style/main.css" />
	</head>
	<body>
		<div id = "page">
			<h1>Note detail</h1>
		
			<?php
        	    $title =  "";
        	    $fileTitle = "";
        
        	    // accessing data from get method
				if($_SERVER["REQUEST_METHOD"] == "GET"):
					$title = $_GET["title"];
					$fileTitle = $title . ".txt";
					echo "<h2>$title</h2>";
					$myfile = fopen($fileTitle, "r") or die("unable to open file!");
					while(!feof($myfile)):
						echo fgets($myfile)."<br/>";
                	endwhile;
					fclose($myfile);
            	endif;
			?>
		
			<h3><a href="index.php" target="blank">Back to Home Page</a></h3>
		</div>
		<?php include_once 'footer.html'; ?>
	</body>
</html>