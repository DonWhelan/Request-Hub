<?php

    function select_prepared_teamEditUser($dir,$company) {

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

        if ($stmt = mysqli_prepare($connection, "SELECT uid, username, email, teams FROM users WHERE company = ?")) {
            mysqli_stmt_bind_param($stmt, "s", $company);
            mysqli_stmt_execute($stmt);
            $uid = "";
            $resultUsername = "";
            $resultEmail = "";
            $resultTeams = "";
            mysqli_stmt_bind_result($stmt, $uid, $resultUsername, $resultEmail, $resultTeams);   
            while (mysqli_stmt_fetch($stmt)) {
                $countOfTeams = substr_count($resultTeams,";");
                $countOfTeams++;
                echo "<tr>
                      <th scope='row'>".$resultUsername."</th>
                      <td>".$resultEmail."</td>
                      <td>".$countOfTeams."</td>
                      <td><a href='teamEditUserAmend.php?uid=".$uid."'><button class='btn btn-outline-success btn-xs float-right' type='submit'>edit</button></a></td>
                      </tr>";
            }
            mysqli_stmt_close($stmt);
        }
       mysqli_close($connection);
    }
    
    
    function select_prepared_teamEditUserAmend($dir,$uid, $company) {
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

        if ($stmt = mysqli_prepare($connection, "SELECT username, email, teams FROM users WHERE uid = ? AND company = ?")) {
            mysqli_stmt_bind_param($stmt, "ss", $uid, $company);
            mysqli_stmt_execute($stmt);
            $resultUsername = "";
            $resultEmail = "";
            $resultTeams = "";
            mysqli_stmt_bind_result($stmt, $resultUsername, $resultEmail, $resultTeams);   
            while (mysqli_stmt_fetch($stmt)) {
                $name = $resultUsername;
                $email = $resultEmail;
                $teams = $resultTeams;
                $returnArray = array('name' => $email, 'email' => $email, 'teams' => $teams);
                return $returnArray;
            }
            mysqli_stmt_close($stmt);
        }
      mysqli_close($connection);
    }
    
?>