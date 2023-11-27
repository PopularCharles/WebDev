<?php 
    session_start();
    $number = "a";

    if (isset($_POST["submit"])) {
        $number = $_POST["moption"];
    }
     function multitable($x)  {
        for ($i = 1; $i <= 15; $i++){
            $result = $i*$x;
            echo $i. " x " . $x . " = " . $result . "<br>";
        }
     }
?>
<html>
    <head>
        <link rel="stylesheet" href="as.css">
        <title>
            Multiplication Table
        </title>
    </head>
    <body>
        <?php if ($_SESSION["status"] == 1) {?>
            <p class = "title" >Multiplication Table</p>
            <form name="multiplication-table-options" method="post" action="">
                <input class = "multextbox" type="number" id="moption" name="moption" value="Insert Number Here" required >
                <input class = "mulsubmit" type ="submit" name="submit">
            </form>
            <div class = "multiform"<?php if ($number == "a") {echo "style = 'display: none'";} ?>>
            <?php if ($number != "a") { ?>
                <p class = "tablehere"><?php multitable($number)?></p>
            <?php } ?>
            </div>
        <?php
            } else { 
        ?>
            <div class = "signin">
                <h1>You are not Signed In <br><a href="index.php" >Sign it here</a> </h1> 
            </div>
        <?php             
            } echo "<br>";
        ?>
        <div style = "margin:  0 0 4% 45.5%; bottom: 0; position: fixed;">
            <a href="index.php" >Home |</a>
            <a href="cal.php" >Calculator</a>
        </div>
        <?php
            include "footer.php"; 
        ?>
    </body>
</html>