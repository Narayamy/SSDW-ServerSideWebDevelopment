<?php
$book = [
    'title' => "The Hitchhiker's Guide to the Galaxy",
    'author' => 'Douglas Adams',
    'description' => 'a comedy sci-fi adventure originally based on a BBC radio series'
];
$characters = [
    'Arthur Dent',
    'Ford Prefect',
    'Zaphod Beeblebrox',
    'Marvin, the paranoid android',
    'Slartibartfast'
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Challenge: Embed in HTML</title>
    <link href="styles.css" rel="stylesheet" type="text/css">
</head>
<body>
<h1>Book<br/>
    <?php
        echo $book['title'] . "<br/>";
        echo $book['author'];
    ?>
</h1>
<p>Description<br/>
    <?php
        echo $book['description'];

    ?>
</p>
<h2>Main Characters<br/>
    <ul>
        <li>
            <?php
                echo $characters[0];
            ?>
        </li>
        <li>
            <?php
                echo $characters[1];
            ?>
        </li>
        <li>
            <?php
                echo $characters[2];
            ?>
        </li>
        <li>
            <?php
                echo $characters[3];
            ?>
        </li>
        <li>
            <?php
                echo $characters[4];
            ?>
        </li>
    </ul>
</h2>

</body>
</html>