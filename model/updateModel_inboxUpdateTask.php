<?php

    function update_prepared_inboxUpdateCurrentTask($dir, $uid, $currentTask, $currentActivity, $taskHops,$expectedResult) {
        // connection details are stored outside the web directory and are defined
        include($dir."../pem/sqlUpdate.php");
        $connection = mysqli_connect(uHOST, uUSER, uPASS);
        if (!$connection) {
            trigger_error("Could not reach database!<br/>");
            error_log("Could not reach database! update_prepared_updateTeam(),", 0);
            exit();
        }
        $db_selected = mysqli_select_db($connection, uDB);
        if (!$db_selected) {
            trigger_error("Could not reach database!<br/>");
            error_log("Could not reach database! mysqli_select_db(),", 0);
            exit();
        }
        // Check connection
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }
        // "UPDATE users SET company = ?  WHERE username = ?
        $stmt = $connection->prepare("UPDATE requests SET currentTask = ?, currentActivity = ?, taskHops = ? WHERE uid = ?");
        $stmt->bind_param("ssii", $currentTask, $currentActivity, $taskHops, $uid);
        if(!$stmt->execute()){
            error_log("Could not reach database! update_prepared_updateTeam(),", 0);
        }
        $affectedRows = mysqli_stmt_affected_rows($stmt);
        // check expected result
        if($affectedRows != $expectedResult){
            error_log("Unexpected DB result! update_prepared_updateTeam(),", 0);
            return false;
        }else{
            return true;
        }
    }
    
    function update_prepared_inboxUpdateCompleate($dir, $uid, $expectedResult) {
        // connection details are stored outside the web directory and are defined
        include($dir."../pem/sqlUpdate.php");
        $connection = mysqli_connect(uHOST, uUSER, uPASS);
        if (!$connection) {
            trigger_error("Could not reach database!<br/>");
            error_log("Could not reach database! update_prepared_updateTeam(),", 0);
            exit();
        }
        $db_selected = mysqli_select_db($connection, uDB);
        if (!$db_selected) {
            trigger_error("Could not reach database!<br/>");
            error_log("Could not reach database! mysqli_select_db(),", 0);
            exit();
        }
        // Check connection
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }
        // "UPDATE users SET company = ?  WHERE username = ?
        $stmt = $connection->prepare("UPDATE requests SET compleate = 1 WHERE uid = ?");
        $stmt->bind_param("i", $uid);
        if(!$stmt->execute()){
            error_log("Could not reach database! update_prepared_updateTeam(),", 0);
        }
        $affectedRows = mysqli_stmt_affected_rows($stmt);
        // check expected result
        if($affectedRows != $expectedResult){
            error_log("Unexpected DB result! update_prepared_updateTeam(),", 0);
            return false;
        }else{
            return true;
        }
    }
    
    //update_prepared_inboxUpdateCompleate
    
   ?>