<!--
Name: Sarah Narayamy Tavares Silva
Student Number: 2960992
-->
<!--
Create a php script called rectangle.php that takes two variables,
a width and height and draws a box similar to the one to the right
using asterisks (*) with blank space in the middle.  
•	Your script should use a function to draw the box. 
    Your function should set default values for the width and height.
•	For the whitespace you should use non breaking space (&nbsp;).
    Since the asterisks take up more room than a space character you may
    need extra space to make the sides of the box line with the top and bottom.
-->

<!DOCTYPE html>
<html>
<head>
<title>Rectangle</title>
<meta charset="UTF-8"/>
</head>
<body>
<h1>Rectangle Shape</h1>

<?php

	function rectangleShape(){
        $width = 4;
        $height = 4;
        for ($i=0; $i<$width; $i++)
        {
          for ($j=0; $j<=$height; $j++)
            {
          if ((($j == 1 or $j == $height) and $i != 0 and $i != $width) or (($i == 0 or $i == $width) and $j > 1 and $j < $height))
                    echo "*";    
                else  
                    echo " ";     
            }        
          echo "\n";
        }
    }

rectangleShape();

?>

</body>
</html>