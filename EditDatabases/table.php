<?php
    session_start();
    include "checkinfo.php";

    $conn = new mysqli($servername, $username, $password, $_SESSION["choosedb"]);

    if (isset($_POST["edit"])) {
        $edit = $_POST["edit"];
    } 


    if (isset($_POST["reset"])) {
        header("refresh");
    } 

    if (isset($_POST["choose"])) {
        $_SESSION["choosetable"] = $_POST["choose"];
        header("Location: tabledetails.php", true, 301);
    } 

    if (isset($_POST["save"])) {
        $tablename = $_POST["save"];
        $tabletypes = array();
        $newsql = "ALTER TABLE " . $tablename . "( ";
        for ($i = 0; $i < $count; $i++){
            $field = $_POST["field".$i];
            $type = $_POST["type".$i];
            if ($type == "varchar"){$number = "(" . $_POST["number".$i] . ")";} else {$number = "";}
            $null = $_POST["null".$i];
            $key = $_POST["key".$i];
            $newsql = $newsql ." ". $field ." ". $type ." ". $number ." ". $null;
            if ($key == "primary key") {$newsql = $newsql ." ,". $key . "(" . $field . "),";} 
            else if ($i == $count - 1) {$newsql = $newsql ." ". $key;}
            else {$newsql = $newsql ." ". $key . ",";}
        }
        $newsql = $newsql . ");";
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
        $newsql = "DROP TABLE " . $delete;
        try {
        if ($conn->query($newsql) === TRUE) {
            $deletestatus = true;
        } else {
            $deletestatus = false;

        }
        } catch (mysqli_sql_exception $e) { }
    } 

    if (isset($_POST["createtable"])) {
        $count = $_POST["createtable"];
        $tablename = $_POST["tablename"];
        $tabletypes = array();
        $newsql = "CREATE TABLE " . $tablename . "( ";
        for ($i = 0; $i < $count; $i++){
            $field = $_POST["field".$i];
            $type = $_POST["type".$i];
            if ($type == "varchar"){$number = "(" . $_POST["number".$i] . ")";} else {$number = "";}
            $null = $_POST["null".$i];
            $key = $_POST["key".$i];
            $newsql = $newsql ." ". $field ." ". $type ." ". $number ." ". $null;
            if ($key == "primary key") {$newsql = $newsql ." ,". $key . "(" . $field . "),";} 
            else if ($i == $count - 1) {$newsql = $newsql ." ". $key;}
            else {$newsql = $newsql ." ". $key . ",";}
        }
        $newsql = $newsql . ");";
        try {
            if ($conn->query($newsql) === TRUE) {
                $createstatus = true;
            } else {
                $createstatus = false;

            }
        } catch (mysqli_sql_exception $e) { }

    } 

    //Tables sql
    $sql = 'SHOW FULL TABLES WHERE TABLE_TYPE = "BASE TABLE";';
    $tables = array();
    $result = $conn->query($sql);
    $tablesinfo = "Tables_in_" . $_SESSION["choosedb"];
    if ($result->num_rows > 0) {
        $i = 0;
        while($row = $result->fetch_assoc()) {
            $tables[$i] = $row[$tablesinfo];
            $i++;
        }
    }

    function showtables($x){
        for ($j = 0; $j < sizeof($x); $j++){
            echo "<tr>
                <td>
                <form method='post' action= " . htmlspecialchars($_SERVER['PHP_SELF']) . ">
                <button type='submit' class = 'showbutton' onclick='return checkDelete()' name = 'choose' value = '" . $x[$j] . "'> ". $x[$j] . "</button> 
                </form>
                </td>
                <td> 
                <form method='post' action= " . htmlspecialchars($_SERVER['PHP_SELF']) . ">
                <button type='submit' class = 'deletebutton' name = 'edit' value = '" . $x[$j] . "'>Edit</button> 
                </form>
                </td> 
                <td> 
                <form method='post' action= " . htmlspecialchars($_SERVER['PHP_SELF']) . ">
                <button type='submit' class = 'deletebutton' onclick='return checkDelete()' name = 'delete' value = '" . $x[$j] . "'>Delete</button> 
                </form>
                </td> 
            </tr>
            ";
        }
    }

    function showinfo($x, $conn) {
        $sqlinfo = 'DESCRIBE ' . $x;
        $tableinfo = array();
        $result = $conn->query($sqlinfo);
        if ($result->num_rows > 0) {
            $i = 0;
            while($row = $result->fetch_assoc()) {
                $tableinfo[$i][0] = $row["Field"];
                $tableinfo[$i][1] = $row["Type"];
                $tableinfo[$i][2] = $row["Null"];
                $tableinfo[$i][3] = $row["Key"];
                $i++;
            }
        }
        echo "<table><tr><th>Field</th><th>Type</th><th>Null</th
        ><th>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspKey</th>
        </tr><form method='post' action= " 
        . htmlspecialchars($_SERVER['PHP_SELF']) . ">";
        for ($j = 0; $j < sizeof($tableinfo); $j++){
            echo "<tr>
                <td> <input type = 'text' class = 'addtextbox1' name = 'column1" . $j . "' value = " . $tableinfo[$j][0] . " pattern='(\D){0,}(\S){1,}' required></td>
                <td><select name='column2" . $j . "' class = 'addtextbox2' onchange='varcharbox(this, 0);'>
                    <option value='" . $tableinfo[$j][1] . "'>" . $tableinfo[$j][1] . "</option>
                    <option value='int'>Int</option>
                    <option value='varchar'>Varchar</option>
                    <option value='boolean'>Boolean</option>
                    <option value='date'>Date</option>
                    <option value='year'>Year</option>
                </select><input type='number' name = 'number" . $j . "' class = 'addtextbox2' id = 'ifYes0' style='display: none;'></td>
                <td><select name='column3" . $j . "' class = 'addtextbox2'>
                <option value='" . $tableinfo[$j][2] . "'>" . $tableinfo[$j][2] . "</option>
                <option value='not null'>Not Null</option>
                <option value='null'>Null</option>
            </select></td>
            <td><select name='column4" . $j . "' class = 'addtextbox4'>
                <option value='" . $tableinfo[$j][3] . "'>" . $tableinfo[$j][3] . "</option>
                <option value=' '>None</option>
                <option value='primary key'>Primary Key</option>
                <option value='unique'>Unique</option>
             </select></td>
            </tr>";
            
        }
        echo "<tr><td><button type = 'submit' class = 'create1' name = 'edit' value = '". $x ."' >Reset</td>
        <td><button type = 'submit' class = 'create1' name = 'save' value = '". $x ."'>Save</td>
        <td class = 'hide'><input name = 'count' value = " . sizeof($tableinfo) . "></td>
        </tr></form></table>";
    }

    function createtable() {
        echo "<form method='post' action= " . htmlspecialchars($_SERVER['PHP_SELF']) . 
        "><table id = 'createtable'>
        <tr><th><input = 'text' class = 'addtextbox1' name = 'tablename' pattern='(\D){0,}(\S){1,}' required placeholder='Table Name Here'></th></tr>
        <tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th></tr>
        <tr>
        <td><input = 'text' class = 'addtextbox1' name = 'field0' pattern='(\D){0,}(\S){1,}' required></td>
        <td><select name='type0' onchange='varcharbox(this, 0);' class = 'addtextbox2'>
            <option value='int'>Int</option>
            <option value='varchar'>Varchar</option>
            <option value='boolean'>Boolean</option>
            <option value='date'>Date</option>
            <option value='year'>Year</option>
        </select><input type='number' class = 'addtextbox2' name = 'number0' id = 'ifYes0' style='display: none;'></td>
        <td><select name='null0'class = 'addtextbox2'>
            <option value='not null'>Not Null</option>
            <option value='null'>Null</option>
        </select></td>
        <td><select name='key0' class = 'addtextbox2'>
            <option value=' '>None</option>
            <option value='primary key'>Primary Key</option>
            <option value='unique'>Unique</option>
        </select></td>
        </tr>
        </table>
        <table><tr>
        <td><button type = 'button' class = 'create2' onclick='addrow()' value='addrow'>Add Row</td>
        <td><button type = 'submit' class = 'create2' onclick='checkDelete' id = 'checkx' name = 'createtable' value= '1' >Submit Table</td>
        </tr></table>
        </form>";
    }

?>
<html>
    <head>
        <title>
            Table Info
        </title>
        <link rel="stylesheet" href="./css/background.css">
        <link rel="stylesheet" href="./css/table.css">
        <script language="JavaScript" type="text/javascript">
            function checkDelete(){
                return confirm('Are you sure?');
            }
            var x = 1;
            function addrow(){
            var d = document.getElementById('createtable');
            d.innerHTML += "<tr><td><input = 'text' class = 'addtextbox1' name = 'field" + x +"' pattern='[^0-9](A-Za-z1-9){0,}[^ ]{1,}' required></td><td><select name='type" + x +"' class = 'addtextbox2' onchange='varcharbox(this, " + x +");'><option value='int'>Int</option><option value='varchar'>Varchar</option><option value='boolean'>Boolean</option><option value='date'>Date</option><option value='year'>Year</option></select><input type='number' class = 'addtextbox2'  name = 'number" + x + "' id = 'ifYes" + x +"' style='display: none;'></td><td><select class = 'addtextbox2' name='null" + x +"'><option value='not null'>Not Null</option><option value='null'>Null</option></select></td><td><select class = 'addtextbox2' name='key" + x +"'><option value=' '>None</option><option value='primary'>Primary Key</option><option value='unique'>Unique</option></select></td></tr>";
            x++;
            document.getElementById("checkx").value = x;
            }
            function varcharbox(that, y) {
                if (that.value == "varchar") {
            alert("add VarChar Number");
                    document.getElementById("ifYes" + y).style.display = "inline-block";
                } else {
                    document.getElementById("ifYes" + y).style.display = "none";
                }
            }
        </script>

    </head>
    <body>
        <?php
            if (isset($_SESSION["username"]) && ($_SESSION["choosedb"])) {
        ?>
        <a href="database.php" style = "position:fixed; margin: -21px 0 0 21px; font-size: 15px;">Back</a>
        <div class = "screencover">
            <div class = "screenarea">
                <table>
                    <tr>
                        <td style = "text-align: center">Table Name</td>
                    </tr>
                    <?php
                        showtables($tables);
                    ?>
                </table> 
            </div>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
            <input type = "submit" class = "create" name = "create" value ="Create Table">
            </form>
        </div>
        <div class = "botcover">
                <?php 
                    if (isset($_POST["edit"])) {
                    echo showinfo($edit, $conn);
                    }
                    if (isset($_POST["create"])) {
                        echo createtable();
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