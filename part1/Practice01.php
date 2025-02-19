
<!-- Triangle Area Calculator -->
<!DOCTYPE html>
<html>
<head>
    <title>Triangle Area Calculator</title>
</head>
<body>
    <h2>Calculate the Area of a Triangle</h2>
    <form method="POST">
        Side 1: <input type="text" name="side1" required><br>
        Side 2: <input type="text" name="side2" required><br>
        Side 3: <input type="text" name="side3" required><br>
        <input type="submit" name="calculate" value="Calculate">
    </form>
    
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $a = $_POST["side1"];
        $b = $_POST["side2"];
        $c = $_POST["side3"];

        if (is_numeric($a) && is_numeric($b) && is_numeric($c)) {
            $a = (float) $a;
            $b = (float) $b;
            $c = (float) $c;

            if ($a + $b > $c && $a + $c > $b && $b + $c > $a) {
                $s = ($a + $b + $c) / 2;
                $area = sqrt($s * ($s - $a) * ($s - $b) * ($s - $c));
                echo "<h3>Triangle Area: " . number_format($area, 2) . " square units</h3>";
            } else {
                echo "<h3>Invalid triangle sides.</h3>";
            }
        } else {
            echo "<h3>Please enter valid numbers.</h3>";
        }
    }
    ?>
</body>
</html>