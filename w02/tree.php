<!--
Name: Sarah Narayamy Tavares Silva
Student Number: 2960992
-->
<!--
Write a PHP script that has a variable called $treeHeight
at the top of the script.
Create a function which prints a tree shape
(as demonstrated in the picture) using asterisks and spaces. 
The tree should have the number of lines indicated
by the tree height. 

-->

<!DOCTYPE html>
<html>
<head>
<title>Tree</title>
<meta charset="UTF-8"/>
</head>
<body>
<h1>Tree Shape</h1>

<?php

	function treeShape(){
        $treeHeight = 10;
        echo "Tree Height: " . $treeHeight . "<br/>";
        
        for($i=1; $i<=$treeHeight; $i++){
        
            for($t=1; $t<=$treeHeight-$i; $t++){
                echo "&nbsp;&nbsp;";
            }
        
            for($j=1;$j<=$i;$j++){
                // use &nbsp; here to procude space after each asterix
                echo "*&nbsp;&nbsp;";
            }
        echo "<br />";
        }
    }

treeShape();

?>

</body>
</html>