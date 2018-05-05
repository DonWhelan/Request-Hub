<?php

    function select_prepared_inboxSelectTeamQueuesFromTeams($dir, $uid) {

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

        if ($stmt = mysqli_prepare($connection, "SELECT teamName FROM teamInboxSelectTeamQueuesFromTeams WHERE uid = ?")) {
            mysqli_stmt_bind_param($stmt, "s", $uid);
            mysqli_stmt_execute($stmt);
            $teamName = "";
            mysqli_stmt_bind_result($stmt, $teamName); 
            mysqli_stmt_fetch($stmt);
            return $teamName;
            mysqli_stmt_close($stmt);
        }
        
       mysqli_close($connection);
    }
    
    function select_prepared_inboxSelectQtyOfRequets($dir, $QueueName) {

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

        if ($stmt = mysqli_prepare($connection, "SELECT COUNT(*) AS 'NumberOfRequests' FROM requests WHERE currentTask = ? and compleate = 0")) {
            mysqli_stmt_bind_param($stmt, "s", $QueueName );
            mysqli_stmt_execute($stmt);
            $numberOfRequests = "";
            mysqli_stmt_bind_result($stmt, $numberOfRequests); 
            mysqli_stmt_fetch($stmt);
            return $numberOfRequests;
            mysqli_stmt_close($stmt);
        }
        
       mysqli_close($connection);
    }
 
?>