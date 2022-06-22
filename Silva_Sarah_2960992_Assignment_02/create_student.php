<!DOCTYPE html >
<html lang="en">
<head>
	<title>Create a User </title>
	<link rel="stylesheet" href="style/Style.css" type="text/css" media="screen" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
<?php # Source: Simplified from Ullman 
// This script performs an INSERT query to add a record to the users table.

include ('header.html');
echo "<h1>Create a Student</h1>";

// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$errors = array(); // Initialize an error array.
	
	// Check for a first name:
	if (empty($_POST['first_name'])) {
		$errors[] = 'You forgot to enter your first name.';
	}
	else {
		$fn = trim($_POST['first_name']);
	}
	
	// Check for a last name:
	if (empty($_POST['last_name'])) {
		$errors[] = 'You forgot to enter your last name.';
	}
	else {
		$ln = trim($_POST['last_name']);
	}

	// Check for an email address:
	if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your email address.';
	}
	else {
		$e = trim($_POST['email']);
	}
	
	// Check for course:
	if (empty($_POST['course'])) {
		$errors[] = 'You forgot to enter your course.';
	}
	else {
		$c = trim($_POST['course']);
	}
	
	// Check for faculty:
	if (empty($_POST['faculty'])) {
		$errors[] = 'You forgot to enter your faculty.';
	}
	else {
		$fac = trim($_POST['faculty']);
	}
	
	if (empty($errors)) { // If everything's OK.
	
		// Create the user in the database...
		
		
		require ('mysqli_connect.php'); // Connect to the db
		
		// Make query data save
		$fn = mysqli_real_escape_string($dbc, trim($fn));
		$ln = mysqli_real_escape_string($dbc, trim($ln));
		$e = mysqli_real_escape_string($dbc, trim($e));
		$c = mysqli_real_escape_string($dbc, trim($c));
		$fac = mysqli_real_escape_string($dbc, trim($fac));
		
		$q = "SELECT * FROM student WHERE email='$e'";
		$r = @mysqli_query($dbc, $q);
		if(mysqli_num_rows($r)==0){
			
			$q = "INSERT INTO student (first_name, last_name, email, course, faculty, registration_date) VALUES ('$fn', '$ln', '$e', '$c', '$fac', NOW() )";		
			$r = @mysqli_query ($dbc, $q); // Run the query.
			if ($r) { // If it ran OK.
	
				// Print a message:
				echo '<p>The student has been created.</p>';	

			}
			else { // If it did not run OK.
	
				// Public message:
				echo '<h2>System Error</h2>
				<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>'; 
	
				// Debugging message:
				echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
				
			} // End of if ($r) IF.
		}
		else{
			echo "The email already exists";
		}
		mysqli_close($dbc); // Close the database connection.
		
		// Include the footer and quit the script:
		include ('footer.html'); 
		exit();
	}	
	else { // Report the errors.
	
		echo '<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		echo '</p><p>Please try again.</p><p><br /></p>';
		
	} // End of if (empty($errors)) IF.

}// End of the main Submit conditional.
?>



<form action="create_student.php" method="post">
	<p>First Name: <input type="text" name="first_name" size="15" maxlength="20" required value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>" /></p>
	<p>Last Name: <input type="text" name="last_name" size="15" maxlength="40" required value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>" /></p>
	<p>Email Address: <input type="text" name="email" size="20" maxlength="60" required value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"  /> </p>
	<p>Course: <input type="text" name="course" size="15" maxlength="60" required value="<?php if (isset($_POST['course'])) echo $_POST['course']; ?>" /></p>
	<p>Faculty: <input type="text" name="faculty" size="20" maxlength="60" required value="<?php if (isset($_POST['faculty'])) echo $_POST['faculty']; ?>"  /> </p>
	<p><input id="button" type="submit" name="submit" value="Create Student" /></p>
</form>

<?php
include ('footer.html');
?>
	</div>
</body>
	

