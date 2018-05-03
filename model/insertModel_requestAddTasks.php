<?php

    function insert_prepared_requestTeamsAndTasks($dir, $owner, $name, $discription, $infoForm, $currentTask, $requestObj, $expectedResult) {
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
        
        $stmt = $connection->prepare("INSERT INTO portfolios (owner, name, description, infoForm, currentTask, requestObj) VALUES (?,?,?,?,?,?)");
        $stmt->bind_param("ssssss", $owner, $name, $discription, $infoForm, $currentTask, $requestObj);
        $stmt->execute();
        $affectedRows = mysqli_stmt_affected_rows($stmt);
        // check expected result
        if($affectedRows != $expectedResult){
            error_log("unexpected result! insert_prepared_requestTeamsAndTasks(),", 0);
            return false;
        }else{
            return true;
        }
    
    }
    
    function insert_prepared_requestTeamsAndTasksTransaction($dir, $owner, $name, $discription, $infoForm, $currentTask, $requestObj, $expectedResult) {
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
        
        // alows transactions
        mysqli_autocommit($connection,FALSE);
        // starts transaction
        mysqli_query($connection,"start transaction");
        
        $stmt = $connection->prepare("INSERT INTO portfolios (owner, name, description, inforForm, currentTask, requestObj) VALUES (?,?,?,?,?,?)");
        $stmt->bind_param("ssssss", $owner, $name, $discription, $infoForm, $currentTask, $requestObj);
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
    
    function insert_prepared_requestTeamsAndTasksRemove($dir, $uid) {
        // connection details are stored outside the web directory and are defined
        include($dir."../pem/sqlDelete.php");
        $connection = mysqli_connect(dHOST, dUSER, dPASS);
        if (!$connection) {
            trigger_error("Could not reach database!<br/>");
            error_log("unable to connect! insert_prepared_teamNew(),", 0);
            exit();
        }
        $db_selected = mysqli_select_db($connection, dDB);
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
        
        $stmt = $connection->prepare("DELETE from portfolios WHERE uid = (?)");
        $stmt->bind_param("s", $uid);
        // check expected result
        if($stmt->execute()){
            error_log("unexpected result! insert_prepared_requestTeamsAndTasks(),", 0);
            return false;
        }else{
            return true;
        }
    
    }
        
?>