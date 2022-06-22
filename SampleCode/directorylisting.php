<!DOCTYPE html>
<!-- This example shows  -->
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Directory listing</title>
	<link rel="stylesheet" href="css/style.css" />
</head>
 <body>

<h1>Directory listing</h1>
	
<?php
echo 'All files in directory -  glob("*")<br />';
foreach (glob("*") as $filename) {
    echo "$filename " . "<br />";
}

echo '<br />All files in sub-directory -  glob("images/*")<br />';
foreach (glob("images/*") as $filename) {
    echo "$filename " . "<br />";
}

echo '<br /><br />Filter the directory listing glob("*.jpg")<br />';
foreach (glob("*.jpg") as $filename) {
    echo "$filename " . "<br />";
}

echo "<br /><br />All files in the images directory -  scandir<br />";
$dir    = "images/";
$files1 = scandir($dir);
foreach ($files1 as $filename) {
    echo "$filename " . "<br />";
}

echo "<br /><br />All files in the current directory scandir<br />";
$dir    = getcwd();
$files1 = scandir($dir);
foreach ($files1 as $filename) {
    echo "$filename " . "<br />";
}
?>

 </body>
 </html> 