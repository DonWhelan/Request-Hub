<?php

    function select_prepared_teamEdit($dir,$company) {

        include($dir."../pem/sqlSelect.php");
        $connection = mysqli_connect(sHOST, sUSER, sPASS);
        if (!$connection) {
            trigger_error("Could not reach database!<br/>");
            include("logs/logsMail-1dir.php");
            exit();
        }
        $db_selected = mysqli_select_db($connection, sDB);
        if (!$db_selected) {
            trigger_error("Could not reach database!<br/>");
            include("logs/logsMail-1dir.php");
            exit();
        }
        /* check connection */
        if (mysqli_connect_errno($connection)) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
        
        /*
         * We have created a view of the users table called userLogonView. It only has access to username and password colums,
         * if details of the query were exploited only u-name and p-word would be exposed and no other personal information.
         */

        if ($stmt = mysqli_prepare($connection, "SELECT uid, teamName, role FROM Teams WHERE owningCompany = ?")) {
            mysqli_stmt_bind_param($stmt, "s", $company);
            mysqli_stmt_execute($stmt);
            $uid = "";
            $resultTeamName = "";
            $resultRole = "";
            mysqli_stmt_bind_result($stmt, $uid, $resultTeamName, $resultRole);   
            while (mysqli_stmt_fetch($stmt)) {
                echo "<li class='list-group-item'>
                      <b>".$resultTeamName . "</b>: " . $resultRole."<a href='teamEditAmend.php?uid=".$uid."'><button class='btn btn-outline-success btn-xs float-right' type='submit'>edit</button>".
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
            include("logs/logsMail-1dir.php");
            exit();
        }
        $db_selected = mysqli_select_db($connection, sDB);
        if (!$db_selected) {
            trigger_error("Could not reach database!<br/>");
            include("logs/logsMail-1dir.php");
            exit();
        }
        /* check connection */
        if (mysqli_connect_errno($connection)) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
        
        /*
         * We have created a view of the users table called userLogonView. It only has access to username and password colums,
         * if details of the query were exploited only u-name and p-word would be exposed and no other personal information.
         */
        $uid = mysqli_real_escape_string($connection,trim($uidFromURL));
        if ($stmt = mysqli_prepare($connection, "SELECT teamName, role FROM Teams WHERE uid = ?")) {
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
            return $array = ["teamName" => null, "role" => null];
        }
       mysqli_close($connection);
    }    
    
?>