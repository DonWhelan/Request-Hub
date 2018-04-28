<?php

    function select_prepared_inboxSelectTeamFromUsers($dir, $username, $company) {

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

        if ($stmt = mysqli_prepare($connection, "SELECT teams FROM users WHERE company = ? AND username = ? LIMIT 1")) {
            mysqli_stmt_bind_param($stmt, "ss", $company, $username);
            mysqli_stmt_execute($stmt);
            $teams = "";
            mysqli_stmt_bind_result($stmt, $teams);   
            mysqli_stmt_fetch($stmt);
            return $teams;
            mysqli_stmt_close($stmt);
        }
        
       mysqli_close($connection);
    }
    
        function select_prepared_inboxSelectTeamFromUsersTransaction($dir, $username, $company) {

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
        
        // alows transactions
        mysqli_autocommit($connection,FALSE);
        // starts transaction
        mysqli_query($connection,"start transaction");
        
        /*
         * We have created a view of the users table called userLogonView. It only has access to username and password colums,
         * if details of the query were exploited only u-name and p-word would be exposed and no other personal information.
         */

        if ($stmt = mysqli_prepare($connection, "SELECT teams FROM users WHERE company = ? AND username = ? LIMIT 1")) {
            mysqli_stmt_bind_param($stmt, "ss", $company, $username);
            mysqli_stmt_execute($stmt);
            $teams = "";
            mysqli_stmt_bind_result($stmt, $teams);   
            mysqli_stmt_fetch($stmt);
            $numrows = $stmt->num_rows;
            if($numrows > 1){
                error_log("unexpected result! select_prepared_inboxSelectTeamFromUsersTransaction(),", 0);
                mysqli_query($connection,"rollback");
                return false;
            }else{
                mysqli_query($connection,"commit");
                return $teams;
            }
            mysqli_stmt_close($stmt);
        }
       mysqli_close($connection);
    }
 
?>