<?php
    session_start();
    include "checkinfo.php";

    $conn = new mysqli($servername, $username, $password);

    if (isset($_POST["submit"])) {
        $add = $_POST["add"];
        $newsql = "CREATE DATABASE " . $add;
        try {
        if ($conn->query($newsql) === TRUE) {
            $createstatus = true;
        } else {
            $createstatus = false;

        }
        } catch (mysqli_sql_exception $e) { }
    } 

    if (isset($_POST["delete"])) {
        $delete = $_POST["delete"];
        $newsql = "DROP DATABASE " . $delete;
        try {
        if ($conn->query($newsql) === TRUE) {
            $deletestatus = true;
        } else {
            $deletestatus = false;

        }
        } catch (mysqli_sql_exception $e) { }
    } 

    if (isset($_POST["choose"])) {
        $_SESSION["choosedb"] = $_POST["choose"];
        header("Location: table.php", true, 301);
    } 


    $sql = 'SHOW DATABASES;';
    $dbs = array();
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $i = 0;
        while($row = $result->fetch_assoc()) {
            $dbs[$i] = $row["Database"];
            $i++;
        }
    }
    function showdatabase($x){
        for ($j = 0; $j < sizeof($x); $j++){
            echo "<tr>
                <td>
                <form method='post' action= " . htmlspecialchars($_SERVER['PHP_SELF']) . ">
                <button type='submit' class = 'showbutton' onclick='return checkDelete()' name = 'choose' value = '" . $x[$j] . "'> ". $x[$j] . "</button> 
                </form>
                </td>
                <td class delete button> 
                <form method='post' action= " . htmlspecialchars($_SERVER['PHP_SELF']) . ">
                <button type='submit' class = 'deletebutton' onclick='return checkDelete()' name = 'delete' value = '" . $x[$j] . "'>Delete</button> 
                </form>
                </td> 
            </tr>
            ";
        }
    }
    if (isset($_POST["submit"]) and $createstatus = true) {
        echo "<script>alert('". $add . " Database Succesfully Created')</script>";
    }
    if (isset($_POST["delete"]) and $deletestatus = true) {
        echo "<script>alert('". $delete . " Database Succesfully Deleted')</script>";
    }
?>
<html>
    <head>
        <title>
            Databases
        </title>
        <link rel="stylesheet" href="./css/background.css">
        <link rel="stylesheet" href="./css/database.css">
        <script language="JavaScript" type="text/javascript">
            function checkDelete(){
                return confirm('Are you sure?');
            }
        </script>
    </head>
    <body>
        <?php
            if (isset($_SESSION["username"])) {
        ?>
        <a href="index.php" style = "position:fixed; margin: -21px 0 0 21px; font-size: 15px;">Back</a>
        <div class = "screencover">
            <div class = "screenarea">
                <table>
                    <tr>
                        <td style= text-align:center;>Database Name</td>
                        <td> </td>
                    </tr>
                    <?php   
                        showdatabase($dbs);
                    ?>
                </table>
            </div>
        </div>

        <div class = 'botcover'>
            <table>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
            <td class = "addtd">
                <input type="text" class = "addtextbox" name="add" pattern = '(\D){0,}(\S){1,}' required placeholder="Enter New Database Name Here">
            </td><td class = "savetd">
                <input type="submit" class = "save" name = "submit" value="save">
            </td>
            </form>
            </table>
        </div>

        <?php
            } else {
        ?>
            <div class = "signin">
                <h1>You are not Signed In <br><a href="index.php" >Sign it here</a> </h1> 
            </div>
        <?php
            }
            $conn->close();
        ?>
    </body>
</html>