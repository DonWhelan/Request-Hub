
<?php

    /* 
     * --------------------------------- Is a model for view newCompanyRegister.php  --------------------------------------
     * - users prepaired statments
     * - includes Update only credentials
     * - uses a view of the users table called userCompanyUpdateView that only shows username amd company
     * - uses transactions
     * ---------------------------------------------------------------------------------------------------------------------
     */

    function update_prepared_updateTeam($dir, $uid, $team, $role,$expectedResult) {
        // connection details are stored outside the web directory and are defined
        include($dir."../pem/sqlUpdate.php");
        $connection = mysqli_connect(uHOST, uUSER, uPASS);
        if (!$connection) {
            trigger_error("Could not reach database!<br/>");
            //include("logs/logsMail-1dir.php");
            exit();
        }
        $db_selected = mysqli_select_db($connection, uDB);
        if (!$db_selected) {
            trigger_error("Could not reach database!<br/>");
            //include("logs/logsMail-1dir.php");
            exit();
        }
        // Check connection
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }
        // "UPDATE users SET company = ?  WHERE username = ?
        $stmt = $connection->prepare("UPDATE Teams SET teamName = ?, role = ? WHERE uid = ?");
        $stmt->bind_param("ssi", $team, $role, $uid);
        if($stmt->execute()){
            echo "sucess <br>";
        }else{
            echo "failed run <br>";
        }
        $affectedRows = mysqli_stmt_affected_rows($stmt);
        // check expected result
        if($affectedRows != $expectedResult){
            //include("logs/logsMail.php");
            return false;
        }else{
            return true;
        }
    }
    
    function update_prepared_updateTeam_Transaction($dir, $name, $compamy,$expectedResult) {
        // connection details are stored outside the web directory and are defined
        include($dir."../pem/sqlUpdate.php");
        $connection = mysqli_connect(uHOST, uUSER, uPASS);
        if (!$connection) {
            trigger_error("Could not reach database!<br/>");
            //include("logs/logsMail-1dir.php");
            exit();
        }
        $db_selected = mysqli_select_db($connection, uDB);
        if (!$db_selected) {
            trigger_error("Could not reach database!<br/>");
            //include("logs/logsMail-1dir.php");
            exit();
        }
        // Check connection
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }
        // alows transactions
        mysqli_autocommit($connection,FALSE);
        // starts transaction
        mysqli_query($connection,"start transaction");
        
        // "UPDATE users SET company = ?  WHERE username = ?
        $stmt = $connection->prepare("UPDATE Teams SET teamName = ?, role = ? WHERE uid = ?");
        $stmt->bind_param("ssi", $team, $role, $uid);
        if($stmt->execute()){
            echo "sucess <br>";
        }else{
            echo "failed run <br>";
        }
        $affectedRows = mysqli_stmt_affected_rows($stmt);
        // check expected result
        if($affectedRows != $expectedResult){
            //include("logs/logsMail.php");
            mysqli_query($connection,"rollback");
            return false;
        }else{
            mysqli_query($connection,"commit");
            return true;
        }
    } 
        
?>