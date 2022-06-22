<?php
if (session_status() == PHP_SESSION_NONE) 
{    
	session_start(); 
}
?>

<!DOCTYPE html >
<html lang="en">
<head>
	<title>Pokémon</title>	
	<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
	<body>
<?php
	include ('headerLoggedIn.html');
	
	require ('connect.php');
	
	include ('sidebar.php');
	
	// Make the query:		
	$q = "SELECT * FROM user_info";		

	$r = @mysqli_query ($dbc, $q); // Run the query.
	
	if($r){ //If it ran OK.
		
		$num = mysqli_num_rows($r);
		
		if ($num >0) {
			
			echo "<h1>SUCCESSFULLY CONNECTED</h1>";
			
			/*
			<div id="scrollbar">
				<section id="posts">
			
				</section>
			</div>
			*/
		}
		else {
			echo "We're sorry, but the user could not be retrieved.<br/>";
		}
		
		mysqli_free_result ($r);
	}
	else { // If it did not run OK.
		echo '<p class="error">Oops, something went wrong. We apologize for any inconvenience.</p>';
	
		// Debugging message:
		echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
	
	} // End of if ($r) IF.

	mysqli_close($dbc); // Close the database connection.


	include('info.php');

	include ('footer.html');
?>