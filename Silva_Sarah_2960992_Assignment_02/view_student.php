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
	echo '<h2>View Students</h2>';

	require ('mysqli_connect.php');
		
	// Define the query:
	$q = "SELECT student_id, last_name, first_name, email, course, faculty FROM student ORDER BY student_id ASC";		
	$r = @mysqli_query ($dbc, $q);

	// Count the number of returned rows:
	$num = mysqli_num_rows($r);

	if ($num > 0) { // If it ran OK, display the records.

	// Print how many users there are:
	echo "<p>There are $num students registered.</p>\n";

	// Table header:
	echo '<table id="students">
			<tr>
				<th>Student ID</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
				<th>Course</th>
				<th>Faculty</th>		
				<th>Edit</th>
				<th>Delete</th>
			</tr>
		';
	
	// Fetch and print all the records:
	while ($row = mysqli_fetch_array($r)) {
		echo '<tr>
				<td>' . $row['student_id'] . '</td>
				<td>' . $row['first_name'] . '</td>
				<td>' . $row['last_name'] . '</td>
				<td>' . $row['email'] . '</td>
				<td>' . $row['course'] . '</td>
				<td>' . $row['faculty'] . '</td>
				<td><a href="edit_student.php?id=' . $row['student_id'] . '">Edit</a></td>
				<td><a href="delete_student.php?id=' . $row['student_id'] . '">Delete</a></td>
			</tr>
		';
	}

	echo '</table>';
	mysqli_free_result ($r);	
}
	else { // If no records were returned.
	echo '<p class="error">There are no students registered.</p>';
	}
mysqli_close($dbc);

?>
<?php
	include ('footer.html');
?>
	</div>
</body>