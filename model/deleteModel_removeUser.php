<?php

 function delete_prepared_removeUser($dir,$uid) {

        include($dir."../pem/sqlDelete.php");
        $connection = mysqli_connect(dHOST, dUSER, dPASS);
        if (!$connection) {
            trigger_error("Could not reach database!<br/>");
            error_log("Could not connect! select_prepared_teamEdit_byUID(),", 0);
            exit();
        }
        $db_selected = mysqli_select_db($connection, dDB);
        if (!$db_selected) {
            trigger_error("Could not reach database!<br/>");
            error_log("Could not connect! select_prepared_teamEdit_byUID(),", 0);
            exit();
        }
        /* check connection */
        if (mysqli_connect_errno($connection)) {
            error_log("Could not connect! select_prepared_teamEdit_byUID(),", 0);
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
        $uid = mysqli_real_escape_string($connection,trim($uid));
        if ($stmt = mysqli_prepare($connection, "DELETE FROM users WHERE uid = ?")) {
            mysqli_stmt_bind_param($stmt, "i", $uid);
            mysqli_stmt_execute($stmt);
            $numrows = $stmt->num_rows;
            if($numrows > 1){
                error_log("unexpected result! select_prepared_userLogin(),", 0);
                mysqli_query($connection,"rollback");
                return false;
            }else{
                mysqli_query($connection,"commit");
                return true;
            }
            mysqli_stmt_close($stmt);
        }else{
            error_log("Could not retrive results! select_prepared_teamEdit_byUID(),", 0);
            return false;
        }
       mysqli_close($connection);
    }   

?>