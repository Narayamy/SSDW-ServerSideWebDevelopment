<!DOCTYPE html>
<html lang="en">
<head>
	<title>Sign Up</title>
	<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
<?php 
	include ('headerHome.html');
	echo "<h1>Join our POKÉCLUB</h1>";

	// Check for form submission:
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		$errors = array(); // Initialize an error array.
	
		// Check for a first name:
		if (empty($_POST['first_name'])) {
			$errors[] = 'You forgot to enter your first name.';
		} else {	
			$fn = ucwords(trim($_POST['first_name']));
		}
	
		// Check for a last name:
		if (empty($_POST['last_name'])) {
			$errors[] = 'You forgot to enter your last name.';
		} else {
			$ln = ucwords(trim($_POST['last_name']));
		}
		
		// Check for a nickname:
		if (empty($_POST['nickname'])) {
			$errors[] = 'You forgot to enter your nickname.';
		} else {
			$nn = ucwords(trim($_POST['nickname']));
		}
		
		// Check for an email address:
		if (empty($_POST['email'])) {
			$errors[] = 'You forgot to enter your email address.';
		} else {
			$email = trim($_POST['email']);
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				array_push($errors, "Invalid email format");
			}
			else{
				$e = $email;
			}
		}

		// Check for a date of birth:
		if 	(empty($_POST['dob'])){
			array_push($errors, "Please enter your date of birth");
		} else { 
			$d =  trim($_POST['dob']);
		}
	
		// Check for a gender:
		if 	(empty($_POST['gender'])){
			array_push($errors, "Please enter a gender");
		} else {
			$g =  strtoupper(trim($_POST['gender']));
		}
	
		// Check for a location:
		if (empty($_POST['location'])) {
			$errors[] = 'You forgot to enter your location.';
		} else {
			$l = ucwords(trim($_POST['location']));
		}
	
		// Check for a team:
		if 	(empty($_POST['team'])){
			array_push($errors, "Please enter a team");
		} else {
			$t =  strtoupper(trim($_POST['team']));
		}
	
		// Check for a password and match against the confirmed password:
		if (!empty($_POST['password'])) {
			if ($_POST['password'] != $_POST['confirmPass']) {
				$errors[] = 'Your passwords do not match.';
			} else {
				$p = trim($_POST['password']);
			}
		} else {
			$errors[] = 'You forgot to enter your password.';
		}
	
	
		if (empty($errors)) { // If everything's OK.
	
			// Register the user in the database...
		
			require_once ('connect.php'); // Connect to the db
		
			// Make query data save
			$fn = mysqli_real_escape_string($dbc, trim($fn));
			$ln = mysqli_real_escape_string($dbc, trim($ln));
			$nn = mysqli_real_escape_string($dbc, trim($nn));
			$e = mysqli_real_escape_string($dbc, trim($e));
			$d = mysqli_real_escape_string($dbc, trim($d));
			$g = mysqli_real_escape_string($dbc, trim($g));
			$l = mysqli_real_escape_string($dbc, trim($l));
			$t = mysqli_real_escape_string($dbc, trim($t));
			$p = mysqli_real_escape_string($dbc, trim($p));
		
			//  Test for unique email address:
			$q = "SELECT * FROM user_info WHERE email='$e'";
			$r = @mysqli_query($dbc, $q);
			if (mysqli_num_rows($r) == 0) {
				
				$q = "INSERT INTO user_info (first_name, last_name, nickname, email, dob, gender, location, team, password, registration_date) VALUES ('$fn', '$ln', '$nn','$e', '$d', '$g', '$l', '$t', SHA1('$p'), NOW())";		
				$r = @mysqli_query ($dbc, $q); // Run the query.
					if ($r) { // If it ran OK.
						// Print a message:
						echo '<p>The user has been created. Please go to log in page.</p>';						
					} else { // If it did not run OK.
						// Public message:
						echo '<h2>System Error</h2>
						<p class="error">The user could not be registered due to a system error. We apologize for any inconvenience.</p>'; 
						// Debugging message:
						echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
					} // End of if ($r) IF.
			} else { // Already registered.
				echo '<p class="error">The email address has already been registered.</p>';
			}
		
			mysqli_close($dbc); // Close the database connection.
		
			// Include the footer and quit the script:
			include ('footer.html'); 
			exit();
		
		} else { // Report the errors.
	
			echo '<p class="error">The following error(s) occurred:<br />';
			foreach ($errors as $msg) { // Print each error.
				echo " - $msg<br />\n";
			}
			echo '</p><p>Please try again.</p><p><br /></p>';
		
		} // End of if (empty($errors)) IF.

	} // End of the main Submit conditional.
?>

<hr/><br/><br/><br/>
<div class="form">
	<form action="signup.php" method="post">
		<p><b>First Name: </b><input type="text" name="first_name" size="20" maxlength="60" required value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>" /></p>
		<p><b>Last Name: </b><input type="text" name="last_name" size="20" maxlength="60" required value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>" /></p>
		<p><b>Nickname: </b><input type="text" placeholder="This is what will be displayed to others" name="nickname" size="32" maxlength="20" required value="<?php if (isset($_POST['nickname'])) echo $_POST['nickname']; ?>"/></p>
		<p><b>Email Address: </b><input type="text" placeholder="This will be your username" name="email" size="25" maxlength="60" required value="<?php if (isset($_POST['email'])) echo $_POST['email']; ; ?>"  /> </p>
		<p><b>Date of birth: </b><input type="date" id="dob" name="dob" max ="2002-05-04" placeholder="Date of birth" required value="<?php echo $d;?>"></p>
		<p><b>Gender: </b><input type="radio" id="gender" name="gender" <?php if (isset($gender) && $gender=="Female") echo "checked";?> value="female">Female
					<input type="radio" id="gender" name="gender" <?php if (isset($gender) && $gender=="Male") echo "checked";?> value="male">Male
		<p><b>Location: </b><input type="text" name="location" size="30" maxlength="60" required value="<?php if (isset($_POST['location'])) echo $_POST['location']; ?>" /></p>
		<p><b>Team: </b><input type="radio" id="team" name="team" <?php if (isset($team) && $team=="Valor") echo "checked";?>  value="Valor"/>  <label for="Valor">Valor </label>
				<input type="radio" id="team" name="team"  <?php if (isset($team) && $team=="Instinct") echo "checked";?>  value="Instinct" /> <label for="Instinct">Instinct </label>
				<input type="radio" id="team" name="team"  <?php if (isset($team) && $team=="Mystic") echo "checked";?>  value="Mystic" /> <label for="Mystic">Mystic </label><br/>
		<label for="password">Password: </label> <input type="password" placeholder="Your password should be 6 to 12 characters long" id="password" name="password" size="45" pattern=".{6,12}" required title="6 to 12 characters" value="<?php if (isset($_POST['password'])) echo $_POST['password']; ?>"  /><br/>
		<label for="confirmPass">Confirm Password: </label><input type="password" id="confirmPass" name="confirmPass" size="45" pattern=".{6,12}" required title="6 to 12 characters" value="<?php if (isset($_POST['confirmPass'])) echo $_POST['confirmPass']; ?>"  /><br/>
		<p><input type="submit" name="submit" value="Submit" /></p>
	</form>
</div>
<hr/>

<?php
	include ('footer.html');
?>