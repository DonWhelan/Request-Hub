<?php

    /*
     *   select_prepared_userLogin() takes 1 argument 
     *   it querys a view userLogonView
     *   uses prepaired statments
     *   it returns username, password, salt and numrows ina array
     */   
    
    function select_prepared_customerLogin($valueToFind) {
        // ref : https://www.w3schools.com/php/php_mysql_prepared_statements.asp
        
        include("../../pem/sqlSelect.php");
        $connection = mysqli_connect(sHOST, sUSER, sPASS);
        if (!$connection) {
            trigger_error("Could not reach database!<br/>");
            error_log("Could not connect! select_prepared_userLogin(),", 0);
            exit();
        }
        $db_selected = mysqli_select_db($connection, sDB);
        if (!$db_selected) {
            trigger_error("Could not reach database!<br/>");
            error_log("Could not connect! select_prepared_userLogin(),", 0);
            exit();
        } 
        
        /* check connection */
        if (mysqli_connect_errno($connection)) {
            error_log("Could not connect! select_prepared_userLogin(),", 0);
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
        
        $usernameToFind = $valueToFind;
        
        /*
         * We have created a view of the users table called userLogonView. It only has access to username and password colums,
         * if details of the query were exploited only u-name and p-word would be exposed and no other personal information.
         */  
         
        /* create a prepared statement */
        if ($stmt = mysqli_prepare($connection, "SELECT username, password, salt, company FROM customers WHERE username = ? LIMIT 1")) {
            /* bind parameters for markers */
            mysqli_stmt_bind_param($stmt, "s", $usernameToFind);
            /* execute query */
            mysqli_stmt_execute($stmt);
            /* bind result variables */
            mysqli_stmt_bind_result($stmt, $resultUsername, $resultPassword, $resultSalt, $resultCompany);
            /* fetch value */
            $array = [];
            while (mysqli_stmt_fetch($stmt)) {
                $array = ["username" => $resultUsername, "password" => $resultPassword, "salt" => $resultSalt, "numRows" => "", "company" => $resultCompany ];
            }
            //var_dump($array);
            $numrows = $stmt->num_rows;
            $array["numRows"] = $numrows;
            return $array;
            /* close statement */
            mysqli_stmt_close($stmt);
        }
        
        /* close connection */
        mysqli_close($connection);
    
    }
    
    /*
     *   select_prepared_userLogin_transaction() takes 1 argument
     *   starts a transaction
     *   it querys a view userLogonView
     *   uses prepaired statments
     *   it returns username, password, salt and numrows ina array
     *   If the effected number of rows does match what is thought, the query is commited, if not rolled back
     */    
    
    function select_prepared_customerLogin_transaction($valueToFind) {
        
        include("../../pem/sqlSelect.php");
        $connection = mysqli_connect(sHOST, sUSER, sPASS);
        if (!$connection) {
            trigger_error("Could not reach database!<br/>");
            error_log("Could not connect! select_prepared_userLogin(),", 0);
            exit();
        }
        $db_selected = mysqli_select_db($connection, sDB);
        if (!$db_selected) {
            trigger_error("Could not reach database!<br/>");
            error_log("Could not connect! select_prepared_userLogin(),", 0);
            exit();
        }
        /* check connection */
        if (mysqli_connect_errno($connection)) {
            error_log("Could not connect! select_prepared_userLogin(),", 0);
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
        // alows transactions
        mysqli_autocommit($connection,FALSE);
        // starts transaction
        mysqli_query($connection,"start transaction");
        $usernameToFind = $valueToFind;
        
        /*
         * We have created a view of the users table called userLogonView. It only has access to username and password colums,
         * if details of the query were exploited only u-name and p-word would be exposed and no other personal information.
         */
         
        if ($stmt = mysqli_prepare($connection, "SELECT username, password, salt, company FROM customers WHERE username = ? LIMIT 1")) {
            mysqli_stmt_bind_param($stmt, "s", $usernameToFind);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $resultUsername, $resultPassword, $resultSalt, $resultCompany);
            $array = [];
            while (mysqli_stmt_fetch($stmt)) {
                $array = ["username" => $resultUsername, "password" => $resultPassword, "salt" => $resultSalt, "numRows" => "",  "company" => $resultCompany ];
            }
            $numrows = $stmt->num_rows;
            $array["numRows"] = $numrows;
            if($numrows > 1){
                error_log("unexpected result! select_prepared_userLogin(),", 0);
                mysqli_query($connection,"rollback");
            }else{
                mysqli_query($connection,"commit");
            }
            return $array;
            mysqli_stmt_close($stmt);
        }
        mysqli_close($connection);
    }
?>