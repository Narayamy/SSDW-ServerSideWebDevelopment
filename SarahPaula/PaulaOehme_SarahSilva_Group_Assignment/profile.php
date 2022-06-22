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
	$feedback = "";
			
	$q = "SELECT * FROM user_info WHERE user_id=$id";
	$r = @mysqli_query($dbc, $q);
	$row = mysqli_fetch_assoc($r);
	$pic_id = $row['picture_id'];
	if($pic_id == NULL){
		echo '<form action="profilePicture.php" method="post" enctype="multipart/form-data">
			<input type="image" src="profilePictures/default.jpg" name="avatar" value="avatar" id="avatar" width="100">
			</form>';
	}
	else{
		$q = "SELECT * FROM picture WHERE picture_id=$pic_id";
		$r = @mysqli_query($dbc, $q);
		$row = mysqli_fetch_assoc($r);
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		$target = $row['picture_address'] . $imageFileType;
		echo '<form action="profilePicture.php" method="post" enctype="multipart/form-data">
			<input type="image" src="'.$target.'" name="avatar" value="avatar" id="avatar" width="100">
			</form>';
	}
	
	$q = "SELECT nickname FROM user_info WHERE user_id=$id";
	$r = @mysqli_query ($dbc, $q);
	$row = mysqli_fetch_assoc($r);
	$nickname = $row['nickname'];
	echo "<h3>$nickname</h3>";
	
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
		
		//If everything's OK.
		if (empty($errors)) {
			
			//  Test for unique nickname:
			$q = "SELECT user_id FROM user_info WHERE nickname='$n'";
			$r = @mysqli_query($dbc, $q);
			if (mysqli_num_rows($r) == 1) {
				$row = mysqli_fetch_array ($r);
				if($row[0] == $id){
					$q = "UPDATE user_info SET nickname='$n', location='$l', team='$t' WHERE user_id=$id";
					$r = @mysqli_query ($dbc, $q);
					if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.
						// Print a message:
						$feedback = '<p class="message">Your profile has been succefully updated.</p>';	
					} else { // If it did not run OK.
						echo '<p class="error">Your profile could not be updated due to a system error. We apologize for any inconvenience.</p>'; // Public message.
						echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message.
					} 
				}
				else { // Already registered.
					echo '<p class="error">Another player is already using this nickname.</p>';
				}
			}
			else if (mysqli_num_rows($r) == 0) {
				
				// Make the query:
				$q = "UPDATE user_info SET nickname='$n', location='$l', team='$t' WHERE user_id=$id";
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
				echo '<p class="error">Your profile could not be updated due to a system error. We apologize for any inconvenience.</p>';
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
			<p>Team: <input type="radio" id="team" name="team" value="Valor"/>  <label for="Valor">Valor </label>
				<input type="radio" id="team" name="team" value="Instinct" /> <label for="Instinct">Instinct </label>
				<input type="radio" id="team" name="team"  value="Mystic" /> <label for="Mystic">Mystic </label></p>
			<p><input type="submit" name="submit" value="Update" /></p>
			<input type="hidden" name="id" value="' . $id . '" /></form>';

	} else { // Not a valid user ID.
		echo '<p class="error">This page has been accessed in error.</p>';
	}
	
	
	echo $feedback;
	
	
	include('info.php');
	
	mysqli_close($dbc);
	
	include ('footer.html');
?>