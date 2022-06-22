<!--
Name: Sarah Narayamy Tavares Silva
Student Number: 2960992
-->
<!--
•	Create a php script called nav.php which contains the 
    navigation links for a website, three links to home (home.php),
    aboutus (about.php) and contactus (contact.php).
•	Create the home, aboutus and contact us pages
    which use the ‘Include’ keyword to pull in the nav.php script.   
o	The home page should also have a h1
    “Welcome to Griffith College” and one/two lines of text. 
o	The about us page and the contact us page should also
    have a appropriate h1 saying with one/two line(s) of text.
    You may wishes to look at the Griffith college website for text.
-->

<!DOCTYPE html>
<html>
<head>
<title>Navigation</title>
<meta charset="UTF-8"/>
</head>
<body>
<h1>Navigation</h1>

<?php

include 'aboutUs.php';
include 'contactUs.php';


?>

</body>
</html>