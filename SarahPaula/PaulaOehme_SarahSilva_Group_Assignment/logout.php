<?php
if (session_status() == PHP_SESSION_NONE) 
{    
	session_start(); 
}
?>

<!DOCTYPE html >
<html lang="en">
<head>
	<title>Log out</title>	
	<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
	<body>
		
<?php
	include ('headerHome.html'); 
		function redirect_user ($page) {

			// Start defining the URL...
			// URL is http:// plus the host name plus the current directory:
			$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
	
			// Remove any trailing slashes:
			$url = rtrim($url, '/\\');
	
			// Add the page:
			$url .= '/' . $page;
	
			// Redirect the user:
			header("Location: $url");
			exit(); // Quit the script.

		} // End of redirect_user() function.


		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			require ('connect.php');
		
			if($_POST["logout"] == "No"){
				echo "Yay! Enjoy using our social network.";
				$page = 'feed.php';
				redirect_user ($page);
			}
			if($_POST["logout"] == "Yes"){
				echo "You are being logged out. We hope to see you soon.";
				session_destroy();
				$page = 'index.php';
				redirect_user ($page);
			}
		}
		
		
		echo '<h3>Log out</h3>
		
				<p>Are you sure you want to log out?</p>
				<form action="logout.php" method="post">
					<input type="submit" name="logout" value="No">
					<input type="submit" name="logout" value="Yes">
				</form>';
				
// Display the form:
?>

		