<!--
Name: Sarah Narayamy Tavares Silva
Student Number: 2960992
-->
<!--
Create a php script called heart.php.
Create a string called $heart and assign it a value of “The best and most beautiful things in the world
cannot be seen or even touched, they must be felt with the heart.”

Use a function to count the number of words.  Display the number of words in the string with an appropriate
heading.

Use a function to replace the word “beautiful” with “wonderful”.
Display the new string.

Convert the $heart string to uppercase.
Use a method to split the string into an array of words.
Then use a loop to write every third word to the screen. Use an appropriate heading.

Using functions create a new string $sorted which is the $heart string in alphabetical word order.
Print the new string to the screen with an appropriate heading.
-->

<!DOCTYPE html>
<html>
<head>
<title>Heart</title>
<meta charset="UTF-8"/>
</head>
<body>
<h1>Heart</h1>


<?php
	
	$heart = "The best and most beautiful things in the world cannot be seen or even touched, they must be felt with the heart.";
	
	function coutingWords($heart){
		echo "<h2>Counting the words in the string</h2>";
		$numberOfWords = str_word_count($heart);
		echo $numberOfWords;
	}
	
	coutingWords($heart);
	
	function replaceText($heart){
		echo "<h2>Replacing Beautiful for Wonderful</h2>";
		echo str_replace("beautiful", "wonderful", $heart);
	}
	
	replaceText($heart);
	
	function toUpperCase($heart){
		echo "<h2>Convert the string to Upper case </h2>";
		$heart = strtoupper($heart);
		echo $heart;
		echo "<h2>Spliting the string into an array of words </h2>";
		$words = explode(" ", $heart);
		for($i=2; $i<count($words); $i+=3){
			echo $words[$i]. "<br/>";
		}
	}
	toUpperCase($heart);
	
	
	
?>

</body>
</html>	