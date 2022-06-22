<?php
Echo "Appending a line to a file every time you run this script<br>";
$myfile = fopen('append.txt', 'a');
fwrite($myfile, "Hello\r\n");
fclose($myfile);

?>