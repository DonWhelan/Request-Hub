<?php

    function select_prepared_customersEdit($dir,$company) {

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

        if ($stmt = mysqli_prepare($connection, "SELECT uid, username, email FROM customers WHERE company = ?")) {
            mysqli_stmt_bind_param($stmt, "s", $company);
            mysqli_stmt_execute($stmt);
            $uid = "";
            $resultUsername = "";
            $resultEmail = "";
            mysqli_stmt_bind_result($stmt, $uid, $resultUsername, $resultEmail);   
            while (mysqli_stmt_fetch($stmt)) {
                echo "<tr>
                      <th scope='row'>".$resultUsername."</th>
                      <td>".$resultEmail."</td>
                      <td><a href='customersEditAmend.php?uid=".$uid."'><button class='btn btn-outline-success btn-xs float-right' type='submit'>edit</button></a></td>
                      </tr>";
            }
            mysqli_stmt_close($stmt);
        }
       mysqli_close($connection);
    }
    
    function select_prepared_customersEditAmend($dir,$uid, $company) {
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

        if ($stmt = mysqli_prepare($connection, "SELECT username, email FROM customers WHERE uid = ? AND company = ?")) {
            mysqli_stmt_bind_param($stmt, "ss", $uid, $company);
            mysqli_stmt_execute($stmt);
            $resultUsername = "";
            $resultEmail = "";
            mysqli_stmt_bind_result($stmt, $resultUsername, $resultEmail);   
            while (mysqli_stmt_fetch($stmt)) {
                $name = $resultUsername;
                $email = $resultEmail;
                $returnArray = array('name' => $email, 'email' => $email);
                return $returnArray;
            }
            mysqli_stmt_close($stmt);
        }
      mysqli_close($connection);
    }
    
?>