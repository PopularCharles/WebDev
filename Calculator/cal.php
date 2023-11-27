<?php
    session_start();
    $x = "";
    $y = "";
    $total = "0";
    $z = "0";

    if (isset($_POST["calcsub"])) {
        $x = $_POST["num1"];
        $y = $_POST["num2"];
        $z = $_POST["options"];

        if ($z == "+" ) {
            $total = $x + $y;
        } else if ($z == "-") {
            $total = $x - $y;
        } else if ($z == "x") {
            $total = $x * $y;
        } else if ($z == "÷") {
            if ($y == "0") {
                $total = "Math Error";
            }else{
            $total = $x / $y;
            }
        }
    }

?>
<html>
    <head>
        <link rel="stylesheet" href="as.css">
        <title>
            Calculator
        </title>
    </head>
    <body>
        <?php if ($_SESSION["status"] == 1) { ?>
            <h1 style = "margin: 6% 0 0 43.5%; font-size: 40px">Calculator</h1>
            <div class = "calc">
                <form name = "calculator" method="post" action="">
                    <input class = "caltextboxin" type ="number" id = "num1" name = "num1" value = "<?php echo $x ?>" required>
                    <select class = "options" name = "options" id = "options">
                        <option value="+" <?php if ($z == "+" or "0") {echo "selected";}?>>+</option>
                        <option value="-" <?php if ($z == "-") {echo "selected";}?>>-</option>
                        <option value="x" <?php if ($z == "x") {echo "selected";}?>>x</option>
                        <option value="÷" <?php if ($z == "÷") {echo "selected";}?>>÷</option>
                    </select>
                    <input class = "caltextboxin" type ="number" id = "num2" name = "num2" value = "<?php echo $y ?>"> <br required>
                    <button class = "button" type = "submit" name = "calcsub">=</button> <br>
                    <input class = "answer" type ="text" id = "answer" name = "answer" value = "<?php echo $total ?>" readonly> <br>
                </form>
            </div>
        <?php } else {?>
            <div class = "signin">
                <h1>You are not Signed In <br><a href="login.php" >Sign it here</a> </h1> 
            </div>
        <?php 
            } echo "<br>" ;
        ?>
        <div style = "margin: 0 0 5% 43.5%; bottom: 0; position: fixed; ">
            <a href="index.php" >Home |</a>
            <a href="multi.php" >Multiplication Table</a>
        </div>
        <?php
            include "footer.php"; 
        ?>

    </body>
</html>