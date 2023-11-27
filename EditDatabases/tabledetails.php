<?php
    session_start();
    include "checkinfo.php";

    $conn = new mysqli($servername, $username, $password, $_SESSION["choosedb"]);

        //get table column names
        $sqlinfo = 'DESCRIBE ' . $_SESSION["choosetable"];
        $tableinfo = array();
        $result = $conn->query($sqlinfo);
        if ($result->num_rows > 0) {
            $i = 0;
            while($row = $result->fetch_assoc()) {
                $tableinfo[$i] = $row["Field"];
                $i++;
            }
        }
        
        //get table data
        $sql = 'SELECT * FROM ' . $_SESSION["choosetable"];
        $tabledata = array();
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $k = 0;
            while($row = $result->fetch_assoc()) {
                for ($j = 0; $j < sizeof($tableinfo); $j++){
                    $tabledata[$k][$j] = $row[$tableinfo[$j]];
                }
                $k++;
            }
        }

    if (isset($_POST["edit"])) {
        $edit = $_POST["edit"];
    } 
    
    if (isset($_POST["delete"])) {
        $delete = $_POST["delete"];
        $savesql = "DELETE FROM " . $_SESSION["choosetable"]. " WHERE ";
        for ($j = 0; $j < sizeof($tableinfo); $j++) {
            $savesql = $savesql . $tableinfo[$j] . " = '" . $tabledata[$delete][$j] . "'";
            if ($j < sizeof($tableinfo) - 1) {
                $savesql = $savesql . " AND ";
            }
        }
        try {
            if ($conn->query($savesql) === TRUE) {
            } else {
            }
        } catch (mysqli_sql_exception $e) { }
    } 

    if (isset($_POST["save"])) {
        $count = $_POST["save"];
        $savesql = "DELETE FROM " . $_SESSION["choosetable"]. " WHERE ";
        for ($j = 0; $j < sizeof($tableinfo); $j++) {
            $savesql = $savesql . $tableinfo[$j] . " = '" . $tabledata[$count][$j] . "'";
            if ($j < sizeof($tableinfo) - 1) {
                $savesql = $savesql . " AND ";
            }
        }
        try {
            if ($conn->query($savesql) === TRUE) {
            } else {
            }
        } catch (mysqli_sql_exception $e) { }

        $savesql2 = "INSERT INTO " . $_SESSION["choosetable"] . "(";
        for ($j = 0; $j < sizeof($tableinfo); $j++) {
            $savesql2 = $savesql2 . $tableinfo[$j];
            if ($j < sizeof($tableinfo) - 1) {
                $savesql2= $savesql2 . ", ";
            }
        }
        $savesql2 = $savesql2 . ") VALUES (";
        for ($j = 0; $j < sizeof($tableinfo); $j++) {
            $savesql2 = $savesql2 . "'" . $_POST["row" . $j] . "'";
            if ($j < sizeof($tableinfo) - 1) {
                $savesql2 = $savesql2 . ", ";
            }
        }
        $savesql2 = $savesql2 . ");";
        try {
            if ($conn->query($savesql2) === TRUE) {
                $savestatus = true;
            } else {
                $savestatus = false;

            }
        } catch (mysqli_sql_exception $e) { }   
    }

    if (isset($_POST["create"])) {
        $savesql2 = "INSERT INTO " . $_SESSION["choosetable"] . "(";
        for ($j = 0; $j < sizeof($tableinfo); $j++) {
            $savesql2 = $savesql2 . $tableinfo[$j];
            if ($j < sizeof($tableinfo) - 1) {
                $savesql2= $savesql2 . ", ";
            }
        }
        $savesql2 = $savesql2 . ") VALUES (";
        for ($j = 0; $j < sizeof($tableinfo); $j++) {
            $savesql2 = $savesql2 . "'" . $_POST["row" . $j] . "'";
            if ($j < sizeof($tableinfo) - 1) {
                $savesql2 = $savesql2 . ", ";
            }
        }
        $savesql2 = $savesql2 . ");";
        try {
            if ($conn->query($savesql2) === TRUE) {
                $savestatus = true;
            } else {
                $savestatus = false;

            }
        } catch (mysqli_sql_exception $e) { }   
    }

    //get table data again after delete
    $sql = 'SELECT * FROM ' . $_SESSION["choosetable"];
    $tabledata = array();
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $k = 0;
        while($row = $result->fetch_assoc()) {
            for ($j = 0; $j < sizeof($tableinfo); $j++){
                $tabledata[$k][$j] = $row[$tableinfo[$j]];
                }
                $k++;
            }
        }

    function showtables($x, $y){
        echo "<tr>";
        for ($k = 0; $k < sizeof($y); $k++){
            echo "<td style = 'text-align:center'>". $y[$k] ."</td>";
        }
        echo "</tr>";
        for ($j = 0; $j < sizeof($x); $j++){
            echo "</tr><tr><form method='post' action= " . htmlspecialchars($_SERVER['PHP_SELF']) . ">";
            for ($i = 0; $i < sizeof($y); $i++){
                echo "<td class = 'tablelength'>
                <input type='text' class = 'addtextbox1' name = 'row". $j . $i ."' value = '" . $x[$j][$i] . "' readonly >
                </td>";
            }
            echo "<td> 
                <form method='post' action= " . htmlspecialchars($_SERVER['PHP_SELF']) . ">
                <button type='submit'style = 'margin: 12px 0 0 40px' class = 'deletebutton1' name = 'edit' value = '" . $j . "' >Edit</button> 
                </form>
                </td>
                <td> 
                <form method='post' action= " . htmlspecialchars($_SERVER['PHP_SELF']) . ">
                <button type='submit' style = 'margin: 30px 0 0 52px' class = 'deletebutton1' onclick='return checkDelete()' name = 'delete' value = '" . $j . "'>Delete</button> 
                </form>
                </td> 
                </tr>";
        }
    }

    function tableline($edit, $x, $y){
        echo "<table><tr>";
        for ($k = 0; $k < sizeof($y); $k++){
            echo "<td style = 'text-align:center'>". $y[$k] ."</td>";
        }
        echo "</tr><tr><form method='post' action= " . htmlspecialchars($_SERVER['PHP_SELF']) . ">";
        for ($i = 0; $i < sizeof($y); $i++){
            echo "<td class = 'tablelength'>
            <input type='text' class = 'addtextbox1' name = 'row". $i ."' value = '" . $x[$edit][$i] . "' >
            </td>";
        }
        echo "<button type = 'submit' class = 'create' name = 'save' value ='". $edit ."'>Save Changes</button>
        </form>";
    }

    function createline($x){
        echo "<table><tr>";
        for ($k = 0; $k < sizeof($x); $k++){
            echo "<td style = 'text-align:center'>". $x[$k] ."</td>";
        }
        echo "</tr><tr><form method='post' action= " . htmlspecialchars($_SERVER['PHP_SELF']) . ">";
        for ($i = 0; $i < sizeof($x); $i++){
            echo "<td class = 'tablelength'>
            <input type='text' class = 'addtextbox1' name = 'row". $i ."' value = '' required>
            </td>";
        }
        echo "<button type = 'submit' class = 'create' name = 'create' value =' '>Save Changes</button>
        </form>";
    }
?>
<html>
    <head>
        <title>
            Table Data
        </title>
        <link rel="stylesheet" href="./css/background.css">
        <link rel="stylesheet" href="./css/tabledetails.css">
        <script language="JavaScript" type="text/javascript">
            function checkDelete(){
                return confirm('Are you sure?');
            }
        </script>
    </head>

    <body>
        <?php
                if (isset($_SESSION["username"]) && ($_SESSION["choosedb"]) && ($_SESSION["choosetable"])) {
            ?>
            <a href="table.php" style = "position:fixed; margin: -21px 0 0 21px; font-size: 15px;">Back</a>
            <div class = "screencover">
                <div class = "screenarea">
                    <table>
                        <tr>
                            <td style = "text-align: center"><?php echo $_SESSION["choosetable"]; ?> Table</td>
                        </tr>
                        <?php
                            showtables($tabledata, $tableinfo);
                        ?>
                    </table> 
                </div>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                    <input type = "submit" class = "create" name = "createrow" value ="Create Row">
                </form>
            </div>
            <div class = "botcover">
                <?php 
                    if (isset($_POST["edit"])) {
                    echo tableline($edit, $tabledata, $tableinfo);
                    }
                ?>

                <?php
                    if (isset($_POST["createrow"])) {
                        echo createline($tableinfo);
                    }
                ?>
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