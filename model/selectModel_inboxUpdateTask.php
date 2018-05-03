<?php

    function select_prepared_inboxSelectRequestByRid($dir, $rid) {

        include($dir."../pem/sqlSelect.php");
        $connection = mysqli_connect(sHOST, sUSER, sPASS);
        if (!$connection) {
            trigger_error("Could not reach database!<br/>");
            error_log("Could not connect! select_prepared_teamEdit(),", 0);
            exit();
        }
        $db_selected = mysqli_select_db($connection, sDB);
        if (!$db_selected) {
            trigger_error("Could not reach database!<br/>");
            error_log("Could not connect! select_prepared_teamEdit(),", 0);
            exit();
        }
        /* check connection */
        if (mysqli_connect_errno($connection)) {
            error_log("Could not connect! select_prepared_teamEdit(),", 0);
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
        
        /*
         * We have created a view of the users table called userLogonView. It only has access to username and password colums,
         * if details of the query were exploited only u-name and p-word would be exposed and no other personal information.
         */

        if ($stmt = mysqli_prepare($connection, "SELECT requestObj, taskHops, currentTask FROM requests WHERE uid = ?")) {
            mysqli_stmt_bind_param($stmt, "s", $rid);
            mysqli_stmt_execute($stmt);
            $requestObj = "";
            $taskHops = "";
            $currentTask = "";
            mysqli_stmt_bind_result($stmt, $requestObj, $taskHops,$currentTask); 
            while(mysqli_stmt_fetch($stmt)){
                $array = array('taskHops' => $taskHops, 'requestObj' => $requestObj, 'currentTask' => $currentTask);
            }
            return $array;
            mysqli_stmt_close($stmt);
        }
        
       mysqli_close($connection);
    }
    
?>