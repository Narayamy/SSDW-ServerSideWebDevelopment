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
	
	include('sidebar.php');
	
	$id = $_SESSION['user_id'];
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
						
		
		$errors = array();
	
		// Check for a nickname:
		if (empty($_POST['nickname'])) {
			$errors[] = 'You forgot to enter your nickname.';
		} else {
			$n = mysqli_real_escape_string($dbc, trim($_POST['nickname']));
		}
		
		// Check for a location:
		if (empty($_POST['location'])) {
			$errors[] = 'You forgot to enter your location.';
		} else {
			$l = mysqli_real_escape_string($dbc, trim($_POST['location']));
		}

		// Check for a team:
		if (empty($_POST['team'])) {
			$errors[] = 'You forgot to enter your team.';
		} else {
			$t = mysqli_real_escape_string($dbc, trim($_POST['team']));
		}
		
		$e = $_SESSION['email'];
		list ($check, $data) = check_password($dbc, $_POST['currentPassword']);
		function check_login($dbc, $e, $currentPassword = '') {

			$errors = array(); // Initialize error array.
			
			// Validate the password:
			if (empty($currentPassword)) {
				$errors[] = 'You forgot to enter your password.';
			} else {
				$p = mysqli_real_escape_string($dbc, trim($currentPassword));
			}
			
			if (empty($errors)) { // If everything's OK.

				// Retrieve the user_id and nickname for that email/password combination:
				$q = "SELECT user_id, nickname, email, dob, gender, location, team FROM user_info WHERE email='$email' AND password=SHA1('$p')";		
				$r = @mysqli_query ($dbc, $q); // Run the query.
		
				// Check the result:
				if (mysqli_num_rows($r) == 1) {

					// Fetch the record:
					$row = mysqli_fetch_array ($r, MYSQLI_ASSOC);
	
					// Return true and the record:
					return array(true, $row);
			
				} else { // Not a match!
					$errors[] = 'The current password entered do not match those on file.';
				}
			}
			
			// Return false and the errors:
			return array(false, $errors);

		}
		
		if ($check) {
			if (empty($_POST['currentPassword'])) {
				$errors[] = 'You forgot to enter your current password.';
			} else {
				$current = mysqli_real_escape_string($dbc, trim($_POST['currentPassword']));
			}
		}
		// Check for a new password and match against the confirmed password:
		if (!empty($_POST['newPassword'])) {
			if ($_POST['newPassword'] != $_POST['confirmPass']) {
				$errors[] = 'Your passwords do not match.';
			} else {
				$p = trim($_POST['newPassword']);
			}
		} else {
			$errors[] = 'You forgot to enter your new password.';
		}
		
		//If everything's OK.
		if (empty($errors)) {
			
			$n = mysqli_real_escape_string($dbc, trim($n));
			$l = mysqli_real_escape_string($dbc, trim($l));
			$t = mysqli_real_escape_string($dbc, trim($t));
			
			//  Test for unique nickname:
			$q = "SELECT * FROM user_info WHERE nickname='$n'";
			$r = @mysqli_query($dbc, $q);
			if (mysqli_num_rows($r) == 0) {
				
				// Make the query:
				$q = "UPDATE user_info SET nickname='$n', location='$l', team='$t', password=SHA1('$p')  WHERE user_id=$id";
				$r = @mysqli_query ($dbc, $q);
				if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.
					// Print a message:
					echo '<p class="message">Your profile has been succefully updated.</p>';	
				} else { // If it did not run OK.
					echo '<p class="error">Your profile could not be updated due to a system error. We apologize for any inconvenience.</p>'; // Public message.
					echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message.
				} 
			}
			else { // Already registered.
				echo '<p class="error">This nickname has already been registered.</p>';
			}
		}
		else { // Report the errors.
			echo '<p class="error">The following error(s) occurred:<br />';
			foreach ($errors as $msg) { // Print each error.
				echo " - $msg<br />\n";
			}
			echo '</p><p>Please try again.</p>';
	
		} // End of if (empty($errors)) IF.

	} // End of submit conditional.

	// Always show the form...

	// Retrieve the user's information:
	$q = "SELECT nickname, location, team FROM user_info WHERE user_id=$id";		
	$r = @mysqli_query ($dbc, $q);

	if (mysqli_num_rows($r) == 1) { // Valid user ID, show the form.

		// Get the user's information:
		$row = mysqli_fetch_array ($r);
	
		// Create the form:
		echo '<form action="profile.php" method="post">
			<p>Nickname: <input type="text" name="nickname" size="15" maxlength="15" value="' . $row['nickname'] . '" /></p>
			<p>Location: <input type="text" name="location" size="15" maxlength="30" value="' . $row[1] . '" /></p>
			<p>Team: <input type="radio" id="team" name="team" value="' . $row[2] .'"/>  <label for="Valor">Valor </label>
				<input type="radio" id="team" name="team" value="' . $row[2] .'" /> <label for="Instinct">Instinct </label>
				<input type="radio" id="team" name="team"  value="' . $row[2] .'" /> <label for="Mystic">Mystic </label></p>
			<p><label for="currentPassword">Current password: </label> <input type="password" id="currentPassword" name="currentPassword" size="45" pattern=".{6,12}" required title="6 to 12 characters" value=""  /></p>
			<p><label for="newPassword">New password: </label> <input type="password" id="newPassword" name="newPassword" size="45" pattern=".{6,12}" required title="6 to 12 characters" value=""  /></p>
			<p><label for="confirmPass">Confirm new password: </label><input type="password" id="confirmPass" name="confirmPass" size="45" pattern=".{6,12}" required title="6 to 12 characters" value=""  /></p>
			<p><input type="submit" name="submit" value="Update" /></p>
			<input type="hidden" name="id" value="' . $id . '" /></form>';

		} else { // Not a valid user ID.
			echo '<p class="error">This page has been accessed in error.</p>';
		}

	mysqli_close($dbc);
	?>
	
	
	<?php 
	
	include('info.php');
	
	
	include ('footer.html');
?>