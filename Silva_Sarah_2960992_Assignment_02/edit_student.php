<!DOCTYPE html >
<html lang="en">
<head>
	<title>Edit a student</title>	
	<link rel="stylesheet" href="style/Style.css" type="text/css" media="screen" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
<?php 
    // This page is for editing a user record.

	include ('header.html'); 
    echo '<h2>Edit a Student</h2>';

    // Check for a val student_id student student_id, through GET or POST:
    if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From view_users.php
		$id = $_GET['id'];
	}
	elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
		$id = $_POST['id'];
	}
	else {
		// No valid ID, kill the script.
		echo '<p class="error"> This page has been accessed in error.</p>';
		include ('footer.html'); 
		exit();
	}

    require ('mysqli_connect.php'); 

    // Check if the form has been submitted:
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	    $errors = array();
	
	// Check for a first name:
	if (empty($_POST['first_name'])) {
		$errors[] = 'You forgot to enter your first name.';
	} else {
		$fn = mysqli_real_escape_string($dbc, trim($_POST['first_name']));
	}
	
	// Check for a last name:
	if (empty($_POST['last_name'])) {
		$errors[] = 'You forgot to enter your last name.';
	} else {
		$ln = mysqli_real_escape_string($dbc, trim($_POST['last_name']));
	}

	// Check for an email address:
	if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		$e = mysqli_real_escape_string($dbc, trim($_POST['email']));
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
	
		//  Test for unique email address:
		$q = "SELECT student_id FROM student WHERE email='$e' AND student_id != '$id'";
		$r = @mysqli_query($dbc, $q);
		if (mysqli_num_rows($r) == 0) {

			// Make the query:
			$q = "UPDATE student SET first_name='$fn', last_name='$ln', email='$e', course = '$c', faculty='$fac' WHERE student_id='$id'";
			$r = @mysqli_query ($dbc, $q);
			if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.

				// Print a message:
				echo '<p>The student has been edited.</p>';	
				
            }
            else { // If student_id not run OK.
				echo '<p class="error">The student could not be edited due to a system error. We apologize for any inconvenience.</p>'; // Public message.
				echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message.
			}
				
        }
        else { // Already registered.
			echo '<p class="error">The email address has already been registered.</p>';
		}
		
    }
    else { // Report the errors.

		echo '<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		echo '</p><p>Please try again.</p>';
	
	}

}

$q = "SELECT first_name, last_name, email, course, faculty FROM student WHERE student_id='$id'";		
$r = @mysqli_query ($dbc, $q);

if (mysqli_num_rows($r) == 1) { // Valid user student_id, show the form.

	// Get the user's information:
	$row = mysqli_fetch_array ($r);
	
	// Create the form:
	echo '<form action="edit_student.php" method="post">
		<p>First Name: <input type="text" name="first_name" size="15" maxlength="15" value="' . $row['first_name'] . '" /></p>
		<p>Last Name: <input type="text" name="last_name" size="15" maxlength="30" value="' . $row[1] . '" /></p>
		<p>Email Address: <input type="text" name="email" size="20" maxlength="60" value="' . $row[2] . '"  /> </p>
		<p>Course: <input type="text" name="course" size="15" maxlength="60" required value="' . $row[3] . '"  /></p>
		<p>Faculty: <input type="text" name="faculty" size="20" maxlength="60" required value="' . $row[4] . '"  /></p>
		<p><input id="button" type="submit" name="submit" value="Submit" /></p>
		<input type="hidden" name="id" value="' . $id . '" />
		</form>';

}
else { // Not a val student_id.
	echo '<p class="error">This page has been accessed in error.</p>';
}

mysqli_close($dbc);		
?>
	</div>
</body>