<?php

    function select_prepared_requestView($dir,$company) {

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

        if ($stmt = mysqli_prepare($connection, "SELECT uid, name, description FROM portfoliosRequestView WHERE owner = ?")) {
            mysqli_stmt_bind_param($stmt, "s", $company);
            mysqli_stmt_execute($stmt);
            $uid = "";
            $resultRequestName = "";
            $resultDiscription = "";
            mysqli_stmt_bind_result($stmt, $uid, $resultRequestName, $resultDiscription);   
            while (mysqli_stmt_fetch($stmt)) {
                echo "<li class='list-group-item'>
                      <b>".$resultRequestName . "</b>: " . $resultDiscription."<a href='inRequest.php?formid=".$uid."'><button class='btn btn-outline-info btn-xs float-right' type='submit'>Request</button>".
                      "</a></li>";
            }
            mysqli_stmt_close($stmt);
        }
       mysqli_close($connection);
    }
    
   function select_prepared_teamEdit_byUID($dir,$uidFromURL) {

        include($dir."../pem/sqlSelect.php");
        $connection = mysqli_connect(sHOST, sUSER, sPASS);
        if (!$connection) {
            trigger_error("Could not reach database!<br/>");
            error_log("Could not connect! select_prepared_teamEdit_byUID(),", 0);
            exit();
        }
        $db_selected = mysqli_select_db($connection, sDB);
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
        
        /*
         * We have created a view of the users table called userLogonView. It only has access to username and password colums,
         * if details of the query were exploited only u-name and p-word would be exposed and no other personal information.
         */
        $uid = mysqli_real_escape_string($connection,trim($uidFromURL));
        if ($stmt = mysqli_prepare($connection, "SELECT teamName, role FROM TeamsTeamEdit_byUID2 WHERE uid = ?")) {
            mysqli_stmt_bind_param($stmt, "i", $uid);
            mysqli_stmt_execute($stmt);
            $resultTeamName = "";
            $resultRole = "";
            $array = [];
            mysqli_stmt_bind_result($stmt, $resultTeamName, $resultRole);   
            while (mysqli_stmt_fetch($stmt)) {
                $array = ["teamName" => $resultTeamName, "role" => $resultRole];
            }
            return $array;
            mysqli_stmt_close($stmt);
        }else{
            error_log("Could not retrive results! select_prepared_teamEdit_byUID(),", 0);
            return $array = ["teamName" => null, "role" => null];
        }
       mysqli_close($connection);
    }    
    
?>