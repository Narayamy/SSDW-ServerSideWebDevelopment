<!--
Name: Sarah Narayamy Tavares Silva
Student Number: 2960992
-->
<!--
•	Create a php script called lang.php.  Create an array called $lang which holds the national
	language of some of the countries.  The country is the key and the language is the value. 
	Populate with the details below.
	Ireland – Irish
	England – English
	France – French
	Denmark – Danish
	Spain – Spanish
	Italy – Italian
•	Print each item of the array on a new line in the following format. 
	“XX is the national language of XX.”
•	Add the following entry to the array
		Sweden – Swedish
•	Use a function to sort the array in descending Country order and print out the array with the heading
	“Languages by Country (descending)”.  Each entry should be in the format “Country – Language”
•	Use a function to sort the array in ascending order of language and print out with a heading
	“Languages”.  Only the language should be printed for each array item.
-->

<!DOCTYPE html>
<html>
<head>
<title>Languages</title>
<meta charset="UTF-8"/>
</head>
<body>
<h1>National Languages</h1>


<?php
	
	$lang = array('Ireland' => 'Irish', 'England' => 'English', 'France' => 'French', 'Denmark' => 'Danish', 'Spain' => 'Spanish', 'Italy' => 'Italian');
	foreach($lang as $k => $v){
		echo "$v is the national language of $k </br>";
	}
	
	echo "<br/><h2>Adding Sweden </h2><br/>";
	$lang['Swedish'] = "Sweden";
	foreach($lang as $k => $v){
		echo "$v is the national language of $k </br>";
	}
	
	function sortDescending($lang){
		echo "<h2>Languages by Country (descending)</h2><br/>";
		krsort($lang);
		foreach($lang as $k => $v){
		echo "$v - $k </br>";
		}
	}
	
	sortDescending($lang);
	
	function sortAscending($lang){
		echo "<h2>Languages</h2><br/>";
		ksort($lang);
		foreach($lang as $k => $v){
		echo "$v </br>";
		}
	}
	
	sortAscending($lang);
	
	
?>

</body>
</html>	