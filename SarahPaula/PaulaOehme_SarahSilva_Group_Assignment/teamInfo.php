<?php
	if (session_status() == PHP_SESSION_NONE) {    
		session_start(); 
	}

	require_once ('connect.php'); // Connect to the db
	
	$id = $_SESSION['user_id'];
	
	$q = "SELECT team FROM user_info WHERE user_id=$id";
	$r = @mysqli_query($dbc, $q);
	if (mysqli_num_rows($r) == 1) {
		$row = mysqli_fetch_array ($r);
		if($row[0] == 'Valor'){
			echo '<style>
						#teamInfo {background: rgba(255, 0, 0, 0.1)}
						</style>';
			echo "<h3>Team Valor</h3>
		
				<p><b>Team Leader:</b> Candela</p>
				<p><b>Team mascot:</b> Moltres</p>
				<p>Team Valor is for those who believe in training hard to win and be the best players.</p>
				<p><b>Team stats:</b></p> ";
				
			$q = "SELECT * FROM user_info WHERE team='Valor'";
			$r = @mysqli_query($dbc, $q);
			$nr = mysqli_num_rows($r);
			if ($nr > 0) {		
				echo "Currently players in this team: $nr <br/>";
			}
			else{
				echo "Currently there are no players registred in this team.<br/>";
			}
			$q = "SELECT * FROM user_info WHERE team='Valor' AND gender='Male'";
			$r = @mysqli_query($dbc, $q);
			$nr = mysqli_num_rows($r);
			if ($nr > 0) {		
				echo "Total male players: $nr <br/>";
			}
			else{
				echo "Currently there are no male players in this team.<br/>";
			}
			$q = "SELECT * FROM user_info WHERE team='Valor' AND gender='Female'";
			$r = @mysqli_query($dbc, $q);
			$nr = mysqli_num_rows($r);
			if ($nr > 0) {		
				echo "Total female players: $nr <br/>";
			}
			else{
				echo "Currently there are no female players in this team. <br/>";
			}
			$q = "SELECT * FROM user_info WHERE team='Valor' GROUP BY location";
			$r = @mysqli_query($dbc, $q);
			$nr = mysqli_num_rows($r);
			if ($nr > 0) {		
				echo '<table><tr>
					<th>Players from: </th></tr>';
				while ($row = mysqli_fetch_array($r)) {
					echo '<tr><td align="left">' .$row['location'] . '</td></tr>';
				}
				echo '</table>';
			}
		}
		else if($row[0] == 'Instinct'){
			echo '<style>
						#teamInfo  {background: rgba(255, 255, 0, 0.1)}
						</style>';
			echo "<h3>Team Instinct</h3>
		
				<p><b>Team Leader:</b> Spark</p>
				<p><b>Team mascot:</b> Zapdos</p>
				<p>Team Instinct is for those who are confident in following their instincts</p>
				<p><b>Team stats:</b></p> ";
				
			$q = "SELECT * FROM user_info WHERE team='Instinct'";
			$r = @mysqli_query($dbc, $q);
			$nr = mysqli_num_rows($r);
			if ($nr > 0) {		
				echo "Currently players in this team: $nr<br/>";
			}
			else{
				echo "Currently there are no players registred in this team.<br/>";
			}
			$q = "SELECT * FROM user_info WHERE team='Instinct' AND gender='Male'";
			$r = @mysqli_query($dbc, $q);
			$nr = mysqli_num_rows($r);
			if ($nr > 0) {		
				echo "Total male players: $nr<br/>";
			}
			else{
				echo "Currently there are no male players in this team.<br/>";
			}
			$q = "SELECT * FROM user_info WHERE team='Instinct' AND gender='Female'";
			$r = @mysqli_query($dbc, $q);
			$nr = mysqli_num_rows($r);
			if ($nr > 0) {		
				echo "Total female players: $nr<br/>";
			}
			else{
				echo "Currently there are no female players in this team.<br/>";
			}
			$q = "SELECT location FROM user_info WHERE team='Instinct'";
			$r = @mysqli_query($dbc, $q);
			$nr = mysqli_num_rows($r);
			if ($nr > 0) {		
				echo '<table><tr>
					<th>Players from: </th></tr>';
				while ($row = mysqli_fetch_array($r)) {
					echo '<tr><td align="left">' .$row['location'] . '</td></tr>';
				}
				echo '</table>';
			}
		}
		else if($row[0] =='Mystic'){
			echo '<style>
						#teamInfo  {background: rgba(0, 0, 255, 0.1)}
						</style>';
			echo "<h3>Team Mystic</h3>
		
				<p><b>Team Leader:</b> Blanche</p>
				<p><b>Team mascot:</b> Articuno</p>
				<p>Team Mystic is for those who are dedicated to study pokemon evolution and all science around them</p>
				<p><b>Team stats:</b></p> ";
				
			$q = "SELECT * FROM user_info WHERE team='Mystic'";
			$r = @mysqli_query($dbc, $q);
			$nr = mysqli_num_rows($r);
			if ($nr > 0) {			
				echo "Currently players in this team: $nr<br/>";
			}
			else{
				echo "Currently there are no players registred in this team.<br/>";
			}
			$q = "SELECT * FROM user_info WHERE team='Mystic' AND gender='Male'";
			$r = @mysqli_query($dbc, $q);
			$nr = mysqli_num_rows($r);
			if ($nr > 0) {			
				echo "Total male players: $nr<br/>";
			}
			else{
				echo "Currently there are no male players in this team.<br/>";
			}
			$q = "SELECT * FROM user_info WHERE team='Mystic' AND gender='Female'";
			$r = @mysqli_query($dbc, $q);
			$nr = mysqli_num_rows($r);
			if ($nr > 0) {			
				echo "Total female players: $nr<br/>";
			}
			else{
				echo "Currently there are no female players in this team.<br/>";
			}
			$q = "SELECT location FROM user_info WHERE team='Mystic'";
			$r = @mysqli_query($dbc, $q);
			$nr = mysqli_num_rows($r);
			if ($nr > 0) {		
				echo '<table><tr>
					<th>Players from: </th></tr>';
				while ($row = mysqli_fetch_array($r)) {
					echo '<tr><td align="left">' .$row['location'] . '</td></tr>';
				}
				echo '</table>';
			}
		}
		else{
			echo "Oops, we coudn't retrieve your team information";
		}
	}

?>