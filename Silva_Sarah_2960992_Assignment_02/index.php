<!DOCTYPE html >
<html lang="en">
<head>
	<title>Student Database System</title>	
	<link rel="stylesheet" href="style/Style.css" type="text/css" media="screen" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>

<?php
	include ('header.html');

	require ('mysqli_connect.php');
		
	// Define the query:
	$q = "SELECT student_id, last_name, first_name, email, course, faculty FROM student ORDER BY student_id ASC";		
	$r = @mysqli_query ($dbc, $q);

	// Count the number of returned rows:
	$num = mysqli_num_rows($r);

	if ($num > 0) { // If it ran OK, display the records.

	// Print how many users there are:
	echo "<p>There are $num students registered.</p>\n";
	echo "<p><a href='view_student.php'>View Students</a></p>";

	mysqli_free_result ($r);	
}
	else { // If no records were returned.
	echo '<p class="error">There are no students registered.</p>';
	}
	mysqli_close($dbc);

	include ('footer.html');

?>
	
	</div>
</body>
