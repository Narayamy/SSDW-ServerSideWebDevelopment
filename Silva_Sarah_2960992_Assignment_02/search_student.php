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
	echo '<h2>Search for a Student</h2>';
	

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
	
		require ('mysqli_connect.php');
	
	
		$id = $_POST['student_id'];
		$fn = $_POST['first_name'];
		$ln = $_POST['last_name'];
	
	
		// Define the query:
		$q = "SELECT student_id, last_name, first_name, email, course, faculty FROM student WHERE student_id ='$id' AND first_name='$fn' AND last_name='$ln'";		
		$r = @mysqli_query ($dbc, $q);

		if(mysqli_num_rows($r) > 0){
		
			echo '<table>
					<tr>
						<th>Student ID</th>
						<th>Last Name</th>
						<th>First Name</th>
						<th>Email</th>
						<th>Course</th>
						<th>Faculty</th>		
						<th>Edit</th>
						<th>Delete</th>
					</tr>';
	
			// Fetch and print all the records:
			while ($row = mysqli_fetch_array($r)) {
				echo '<tr>
					<td>' . $row['student_id'] . '</td>
					<td>' . $row['last_name'] . '</td>
					<td>' . $row['first_name'] . '</td>
					<td>' . $row['email'] . '</td>
					<td>' . $row['course'] . '</td>
					<td>' . $row['faculty'] . '</td>
					<td><a href="edit_student.php?id=' . $row['student_id'] . '">Edit</a></td>
					<td><a href="delete_student.php?id=' . $row['student_id'] . '">Delete</a></td>
				</tr>';
			}
	
			mysqli_free_result ($r);	
		}
		else{
		
			echo '<p class="error">We could not reach the student.</p>';
	
		}
	mysqli_close($dbc);
	}
?>

<form action="search_student.php" method="post">
	<p>Student Id:<input type="text" name="student_id"/>
	<p>First Name:<input type="text" name="first_name"/>
	<p>Last Name:<input type="text" name="last_name"/>
	<input id="button" type="submit" value="Submit"/>
</form>

<?php 
	include ('footer.html');
?>
	</div>
</body>



