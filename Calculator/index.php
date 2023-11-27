<?php
    session_start();
    $_SESSION["status"] = 0;
    if (isset($_POST["submit"])) {
        $name = $_POST["name"];
        $_SESSION["status"] = 1;
    } 
?>
<html>
    <head>
        <link rel="stylesheet" href="as.css">   
        <title>
            Sign Up
        </title>
    </head>
    <body>
        <div class = "middleform">
            <br>
            <?php if ($_SESSION["status"]  == 0) { ?>
                <form name = "login" method="post" action = "">
                    <label class = "namehere"> Name: </label>
                    <input class = "logtextbox" type = "text" name="name" id="name" placeholder = "Name Here"  required> <br>
                    <input class = "logsubmit" type ="submit" name="submit">
                </form>
            <?php } else if ($_SESSION["status"]  == 1) { ?>
                <p class = "welcome">Welcome <?php echo $name ?></p>
                <button class = "linkbutton" ><a class = "linktext" href="cal.php" >Calculator</a></button>
                <button class = "linkbutton" ><a class = "linktext" href="multi.php" >Multiplication Table</a></button>
            <?php } echo "<br>" ;?>
        </div>

        <?php 
            include "footer.php"
        ?>
        
    </body>
</html>