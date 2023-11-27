<?php
    session_start();
    if (isset($_POST["submit"])) {
        $servername = $_POST["servername"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $_SESSION["username"] = $username;
    } 

?>
<html>
    <head>
        <title>
            Home
        </title>
        <link rel="stylesheet" href="./css/login.css">
        <link rel="stylesheet" href="./css/background.css">
    </head>
    <body>
        <div class = "screencover">
            <div class = "screenarea">
                <div class="loginform">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                        <br>
                        <label class = "title">Server Name:</label>
                        <input type="text" class = "addtextbox1" name="servername" required> <br>
                        <label class = "title">Username:</label>
                        <input type="text" class = "addtextbox1" name="username" required><br>
                        <label class = "title">Password:</label>
                        <input type="password" class = "addtextbox1" name="password"><br>
                        <input type="submit" class = "create" name="submit" value="submit">
                    </form>
                </div>
            </div>
        </div>
        <?php 

    if (isset($_POST["submit"])) {
        $conn = new mysqli($servername, $username, $password) ;
        if ($conn -> connect_error) {
            echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
            exit();
        }
        echo "Connection Success, Redirecting to new page";
        header("Location: database.php", true, 301);
    }
        ?>
    </body>
</html>