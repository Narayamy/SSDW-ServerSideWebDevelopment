<?php
Echo "Reading from a file<br>";
$myfile = fopen("append.txt", "r") or die("Unable to open file!");
$text = fread($myfile, filesize("append.txt"));
echo htmlspecialchars($text );
fclose($myfile);
?>