<?php
if (session_status() == PHP_SESSION_NONE) 
{    
	session_start(); 
}
?>

<!DOCTYPE html >
<html lang="en">
<head>
	<title>Log in</title>	
	<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
	<body>
	
<?php
	include ('headerHome.html'); 
		
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		require ('login_functions.inc.php');
		require ('connect.php');
		
		// Check the login: validates the form data, queries the db with the email & password
	// returns true/false variable & array of errors or database result
	list ($check, $data) = check_login($dbc, $_POST['email'], $_POST['password']);
					
	if ($check) { // Valid username and password
		
		$_SESSION['user_id'] = $data['user_id'];
		$_SESSION['nickname'] = $data['nickname'];
		$_SESSION['email'] = $data['email'];
		$_SESSION['dob'] = $data['dob'];
		$_SESSION['gender'] = $data['gender'];
		$_SESSION['location'] = $data['location'];
		$_SESSION['team'] = $data['team'];
		
		
		// Store the HTTP_USER_AGENT: 
		// Extra layer of security to help prevent session hacking.
		// This is a combination of the browser and operating system
		// Could only hack into user's session if they were running 
		// exact same browser and exact same operating system.
		$_SESSION['agent'] = md5($_SERVER['HTTP_USER_AGENT']);

		// Redirect:
		redirect_user('feed.php');
			
	}
	else { // Unsuccessful!
		$errors[] = 'The email address and password entered do not match those on file.';
	} 
	

		}
// Print any error messages, if they exist:
if (isset($errors) && !empty($errors)) {
	echo '<p class="error">The following error(s) occurred:<br />';
	foreach ($errors as $msg) {
		echo " - $msg<br />\n";
	}
	echo '</p><p>Please try again.</p>';
}

// Display the form:
?>

<hr/><br/><br/><br/>
<div class="form">
	<form action="login.php" method="post">
		<label for="email" >Username: </label><input type="text" id="email" name="email" size="20" maxlength="60" required /> <br />
		<label for="password">Password: </label> <input type="password" id="name" name="password" size="20" maxlength="20" required /><br/>
		<input type="submit" value="Log in" />
	</form>
</div>
<hr/>

<?php
	include ('footer.html'); 
?>