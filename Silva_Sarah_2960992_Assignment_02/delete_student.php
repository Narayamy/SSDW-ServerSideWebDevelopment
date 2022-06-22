<!DOCTYPE html >
<html lang="en">
<head>
	<title>Delete a Student</title>	
	<link rel="stylesheet" href="style/Style.css" type="text/css" media="screen" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>

<?php 
// This page is for deleting a student record.
// This page is accessed through view_student.php.

include ('header.html');
echo '<h2>Delete a student</h2>';

// Check for a valid student ID, through GET or POST:
if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From view_student.php
	$id = $_GET['id'];
} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
	$id = $_POST['id'];
} else { // No valid ID, kill the script.
	echo '<p class="error">This page has been accessed in error. Please select a student to delete from the <a href="view_student.php">view student</a> page.</p>';
	include ('footer.html'); 
	exit();
}

require ('mysqli_connect.php');

// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if ($_POST['sure'] == 'Yes') { // Delete the record.

		// Make the query:
		$q = "DELETE FROM student WHERE student_id=$id LIMIT 1";		
		$r = @mysqli_query ($dbc, $q);
		if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.

			// Print a message:
			echo '<p>The student has been deleted.</p>';	

		} else { // If the query did not run OK.
			echo '<p class="error">The student could not be deleted due to a system error.</p>'; // Public message.
			echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message.
		}
	
	} else { 
		echo '<p>The student has NOT been deleted.</p>';	
	}

} else { // Show the form.

	// Retrieve the student's information:
	$q = "SELECT first_name, last_name, email, course, faculty FROM student WHERE student_id='$id'";
	$r = @mysqli_query ($dbc, $q);

	if (mysqli_num_rows($r) == 1) { // Valid student ID, show the form.

		// Get the student's information:
		$row = mysqli_fetch_array ($r);
		
		// Display the record being deleted:
		echo "<h3>Name: $row[first_name] $row[last_name]</h3> <strong>Are you sure you want to delete this student?<strong>";
		
		// Create the form:
		echo '<form id="delete" action="delete_student.php" method="post">
				<input class="radio" type="radio" id="Yes" name="sure" value="Yes"/> 
				<label class="deletion" for="Yes">Yes </label>
				<input class="radio" type="radio" id="No" name="sure" value="No" checked="checked"/> 
				<label class="deletion" for="No">No </label>
				<input id="button" type="submit" name="submit" value="Submit"/>
				<input type="hidden" name="id" value="' . $id . '"/>
			</form>';
	
	} else { // Not a valid student ID.
		echo '<p class="error">This page has been accessed in error.</p>';
	}

} // End of the main submission conditional.

mysqli_close($dbc);
		
include ('footer.html');		
?>
	</div>
</body>
