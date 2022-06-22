<!--
Name: Sarah Narayamy Tavares Silva
Student Number: 2960992
-->
<!--
Create a php script called loops.php.
Using three different implementation of loops,
echo all the odd numbers between 0 and 100 (inclusive),
but not the numbers that are exactly divisible by 7.
-->

<!DOCTYPE html>
<html>
<head>
<title>Loops</title>
<meta charset="UTF-8"/>
</head>
<body>
<h1>Odd Numbers</h1>


<?php
	
	$counter = 1;
	$limit = 100;
	print "First Loop<br/>";
	while($counter <= $limit){
		if($counter%2!=0 && $counter%7!=0){
			echo "$counter<br/>";
		}
		$counter++;
	}
	
	print "Second Loop<br/>";
	for($counter = 1; $counter <= $limit; $counter++){
		if($counter%2!=0 && $counter%7!=0){
			echo "$counter<br/>";
		}
	}
	
	print "Third Loop<br/>";
	$counter = 1;
	do{
		if($counter%2!=0 && $counter%7!=0){
			echo "$counter<br/>";
		}
		$counter++;
	}
	while($counter <= $limit);
	
?>

</body>
</html>	