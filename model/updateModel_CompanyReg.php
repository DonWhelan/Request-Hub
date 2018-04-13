
<?php

    /* 
     * --------------------------------- Is a model for view newCompanyRegister.php  --------------------------------------
     * - users prepaired statments
     * - includes Update only credentials
     * - uses a view of the users table called userCompanyUpdateView that only shows username amd company
     * - uses transactions
     * ---------------------------------------------------------------------------------------------------------------------
     */

    function update_prepared_SetCompanyToUser($dir, $name, $compamy,$expectedResult) {
        // connection details are stored outside the web directory and are defined
        include($dir."../pem/sqlUpdate.php");
        $connection = mysqli_connect(uHOST, uUSER, uPASS);
        if (!$connection) {
            trigger_error("Could not reach database!<br/>");
            error_log("Could not connect! update_prepared_SetCompanyToUser(),", 0);
            exit();
        }
        $db_selected = mysqli_select_db($connection, uDB);
        if (!$db_selected) {
            trigger_error("Could not reach database!<br/>");
            error_log("Could not connect! update_prepared_SetCompanyToUser(),", 0);
            exit();
        }
        // Check connection
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }
        // "UPDATE users SET company = ?  WHERE username = ?
        $stmt = $connection->prepare("UPDATE userCompanyUpdateView SET company = ? WHERE username = ?");
        $stmt->bind_param("ss", $compamy, $name);
        if(!$stmt->execute()){
            error_log("Could not connect! update_prepared_SetCompanyToUser(),", 0);
        }
        $affectedRows = mysqli_stmt_affected_rows($stmt);
        // check expected result
        if($affectedRows != $expectedResult){
            error_log("Unexpected result! update_prepared_SetCompanyToUser(),", 0);
            return false;
        }else{
            return true;
        }
    }
    
    function update_prepared_SetCompanyToUserTransaction($dir, $name, $compamy,$expectedResult) {
        // connection details are stored outside the web directory and are defined
        include($dir."../pem/sqlUpdate.php");
        $connection = mysqli_connect(uHOST, uUSER, uPASS);
        if (!$connection) {
            trigger_error("Could not reach database!<br/>");
            error_log("Could not connect! update_prepared_SetCompanyToUserTransaction(),", 0);
            exit();
        }
        $db_selected = mysqli_select_db($connection, uDB);
        if (!$db_selected) {
            trigger_error("Could not reach database!<br/>");
            error_log("Could not connect! update_prepared_SetCompanyToUserTransaction(),", 0);
            exit();
        }
        // Check connection
        if ($connection->connect_error) {
            error_log("Could not connect! update_prepared_SetCompanyToUserTransaction(),", 0);
            die("Connection failed: " . $connection->connect_error);
        }
        // alows transactions
        mysqli_autocommit($connection,FALSE);
        // starts transaction
        mysqli_query($connection,"start transaction");
        
        // "UPDATE users SET company = ?  WHERE username = ?
        $stmt = $connection->prepare("UPDATE userCompanyUpdateView SET company = ? WHERE username = ?");
        $stmt->bind_param("ss", $compamy, $name);
        if(!$stmt->execute()){
           error_log("Could not connect! update_prepared_SetCompanyToUserTransaction(),", 0);
        }
        $affectedRows = mysqli_stmt_affected_rows($stmt);
        // check expected result
        if($affectedRows != $expectedResult){
            error_log("unexpected results! update_prepared_SetCompanyToUserTransaction(),", 0);
            mysqli_query($connection,"rollback");
            return false;
        }else{
            mysqli_query($connection,"commit");
            return true;
        }
    } 
        
?>