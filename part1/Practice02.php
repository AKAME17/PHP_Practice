<!DOCTYPE html>
<html>
<head>
    <title>Fruit List</title>
</head>
<body>
    <h2>List of Fruits</h2>
    <ol>
        <?php
        $fruits = ["Apple", "Banana", "Orange", "Mango", "Grapes"];

        for ($i = 0; $i < count($fruits); $i++) {
            echo "<li>" . $fruits[$i] . "</li>";
        }
        ?>
    </ol>
</body>
</html>
