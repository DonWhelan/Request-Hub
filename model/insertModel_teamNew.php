<?php

    /*
     *   insert_prepared_imageUpload takes 6 arguments and querys a prepaired statment to call images
     *   exacutes the query and the takes the affeted rows
     *   checks the affected rows agains the expected rows
     *   returns true if affected rows are equal expected rows they match, and false if not
     */     
    
    function insert_prepared_teamNew($dir, $name, $role, $company, $expectedResult) {
        // connection details are stored outside the web directory and are defined
        include($dir."../pem/sqlInsert.php");
        $connection = mysqli_connect(iHOST, iUSER, iPASS);
        if (!$connection) {
            trigger_error("Could not reach database!<br/>");
            error_log("unable to connect! insert_prepared_teamNew(),", 0);
            exit();
        }
        $db_selected = mysqli_select_db($connection, iDB);
        if (!$db_selected) {
            trigger_error("Could not reach database!<br/>");
            error_log("unable to connect! insert_prepared_teamNew(),", 0);
            exit();
        } 
        // Check connection
        if ($connection->connect_error) {
            error_log("unable to connect! insert_prepared_teamNew(),", 0);
            die("Connection failed: " . $connection->connect_error);
        }
        
        $stmt = $connection->prepare("INSERT INTO Teams (teamName, role, owningCompany) VALUES (?,?,?)");
        $stmt->bind_param("sss", $name, $role, $company);
        $stmt->execute();
        $affectedRows = mysqli_stmt_affected_rows($stmt);
        // check expected result
        if($affectedRows != $expectedResult){
            error_log("unexpected result! insert_prepared_teamNew(),", 0);
            return false;
        }else{
            return true;
        }
    }  
    
    function insert_prepared_teamNewTransaction($dir, $name, $role, $company, $expectedResult) {
        // connection details are stored outside the web directory and are defined
        include($dir."../pem/sqlInsert.php");
        $connection = mysqli_connect(iHOST, iUSER, iPASS);
        if (!$connection) {
            trigger_error("Could not reach database!<br/>");
            error_log("unable to connect! insert_prepared_teamNewTransaction(),", 0);
            exit();
        }
        $db_selected = mysqli_select_db($connection, iDB);
        if (!$db_selected) {
            trigger_error("Could not reach database!<br/>");
            error_log("unable to connect! insert_prepared_teamNewTransaction(),", 0);
            exit();
        } 
        // Check connection
        if ($connection->connect_error) {
            error_log("unable to connect! insert_prepared_teamNewTransaction(),", 0);
            die("Connection failed: " . $connection->connect_error);
        }
        
        // alows transactions
        mysqli_autocommit($connection,FALSE);
        // starts transaction
        mysqli_query($connection,"start transaction");
        
        
        $stmt = $connection->prepare("INSERT INTO Teams (teamName, role, owningCompany) VALUES (?,?,?)");
        $stmt->bind_param("sss", $name, $role, $company);
        $stmt->execute();
        $affectedRows = mysqli_stmt_affected_rows($stmt);
        // check expected result
        if($affectedRows != $expectedResult){
            error_log("unexpected result! insert_prepared_teamNewTransaction(),", 0);
            mysqli_query($connection,"rollback");
            return false;
        }else{
            mysqli_query($connection,"commit");
            return true;
        }
    } 


?>