<?php

    function select_prepared_inboxGetTeamNameByUID($dir,$teamUID) {

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

        if ($stmt = mysqli_prepare($connection, "SELECT teamName FROM teamsInboxGetTeamNameByUID WHERE uid = ?")) {
            mysqli_stmt_bind_param($stmt, "s", $teamUID);
            mysqli_stmt_execute($stmt);
            $teamName = "";
            mysqli_stmt_bind_result($stmt, $teamName);   
            mysqli_stmt_fetch($stmt);
            return $teamName;
            mysqli_stmt_close($stmt);
        }
       mysqli_close($connection);
    }
    
    function select_prepared_inboxGetCurrentActivity($dir,$requestUID) {

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

        if ($stmt = mysqli_prepare($connection, "SELECT currentActivity FROM requests WHERE uid = ?")) {
            mysqli_stmt_bind_param($stmt, "s", $requestUID);
            mysqli_stmt_execute($stmt);
            $currentActivity = "";
            mysqli_stmt_bind_result($stmt, $currentActivity);   
            mysqli_stmt_fetch($stmt);
            return $currentActivity;
            mysqli_stmt_close($stmt);
        }
       mysqli_close($connection);
    }
    
    function select_prepared_inboxGetRequestsForTeam($dir,$company, $team, $Qid) {

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

        if ($stmt = mysqli_prepare($connection, "SELECT uid, name, submitter, owner FROM requestsInboxGetRequestsForTeam WHERE currentTask = ? AND owner = ? AND compleate = 0 ORDER BY uid")) {
            mysqli_stmt_bind_param($stmt, "ss", $team, $company);
            mysqli_stmt_execute($stmt);
            $uid = "";
            $resultName = "";
            $resultSubmitter = "";
            $resultOwner = "";
            mysqli_stmt_bind_result($stmt, $uid, $resultName, $resultSubmitter, $resultOwner);
            while (mysqli_stmt_fetch($stmt)) {
               echo "<tr>
                      <th scope='row'>".$uid."</th>
                      <td>".$resultName."</td>
                      <td>".$resultSubmitter."</td>
                      <td>".$resultOwner."</td>
                      <td><a href='inboxViewRequest.php?uid=".$uid."&Qid=".$Qid."'><button class='btn btn-outline-success btn-xs float-right' type='submit'>view</button></a></td>
                    </tr>";
            }
            mysqli_stmt_close($stmt);
        }
       mysqli_close($connection);
    }
    
    function select_prepared_inboxGetRequestsFromRid($dir,$company, $team, $Rid, $qid) {
        
        // echo $company;
        // echo $team;
        // echo $Rid;
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

        if ($stmt = mysqli_prepare($connection, "SELECT uid, name, submitter, owner, infoForm FROM requestsInboxGetRequestsFromRid WHERE currentTask = ? and owner = ? AND uid = ?")) {
            mysqli_stmt_bind_param($stmt, "sss", $team, $company, $Rid);
            mysqli_stmt_execute($stmt);
            $uid = "";
            $resultName = "";
            $resultSubmitter = "";
            $resultOwner = "";
            $infoForm = "";
            mysqli_stmt_bind_result($stmt, $uid, $resultName, $resultSubmitter, $resultOwner, $infoForm);
            while (mysqli_stmt_fetch($stmt)) {
               echo "<tr>
                      <th scope='row'>".$uid."</th>
                      <td>".$resultName."</td>
                      <td>".$resultSubmitter."</td>
                      <td>".$resultOwner."</td>
                      <td><a href='../../controler/inboxUpdateTask.php?Rid=".$uid."&Qid=".$qid."'><button class='btn btn-outline-success btn-xs float-right' type='submit'>Compleate</button></a></td>
                    </tr>";
            }
            return $infoForm;
            mysqli_stmt_close($stmt);
        }
       mysqli_close($connection);
    }
    
?>