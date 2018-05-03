<?php

    function select_prepared_dashboardGetTeams($dir,$company) {

        include($dir."../pem/sqlSelect.php");
        $connection = mysqli_connect(sHOST, sUSER, sPASS);
        if (!$connection) {
            trigger_error("Could not reach database!<br/>");
            error_log("Could not connect! select_prepared_dashboardGetTeams(),", 0);
            exit();
        }
        $db_selected = mysqli_select_db($connection, sDB);
        if (!$db_selected) {
            trigger_error("Could not reach database!<br/>");
            error_log("Could not connect! select_prepared_dashboardGetTeams(),", 0);
            exit();
        }
        /* check connection */
        if (mysqli_connect_errno($connection)) {
            error_log("Could not connect! select_prepared_dashboardGetTeams(),", 0);
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
        
        /*
         * We have created a view of the users table called userLogonView. It only has access to username and password colums,
         * if details of the query were exploited only u-name and p-word would be exposed and no other personal information.
         */

        if ($stmt = mysqli_prepare($connection, "SELECT teamName FROM Teams WHERE owningCompany = ?")) {
            mysqli_stmt_bind_param($stmt, "s", $company);
            mysqli_stmt_execute($stmt);
            $resultTeamName = "";
            mysqli_stmt_bind_result($stmt, $resultTeamName); 
            $array = array();
            while (mysqli_stmt_fetch($stmt)) {
                array_push($array,$resultTeamName);
            }
            $count = count($array);
            echo "[";
            foreach ($array as $i) { 
                echo "'".$i."'";
                $count --;
                if(!$count == 0){
                   echo ", "; 
                }
            }
            echo "],";
            return $array;
            mysqli_stmt_close($stmt);
        }
       mysqli_close($connection);
    }
    
    function select_prepared_dashboardGetQTYs($dir, $arrayOfTeamNames) {

        include($dir."../pem/sqlSelect.php");
        $connection = mysqli_connect(sHOST, sUSER, sPASS);
        if (!$connection) {
            trigger_error("Could not reach database!<br/>");
            error_log("Could not connect! select_prepared_dashboardGetTeams(),", 0);
            exit();
        }
        $db_selected = mysqli_select_db($connection, sDB);
        if (!$db_selected) {
            trigger_error("Could not reach database!<br/>");
            error_log("Could not connect! select_prepared_dashboardGetTeams(),", 0);
            exit();
        }
        /* check connection */
        if (mysqli_connect_errno($connection)) {
            error_log("Could not connect! select_prepared_dashboardGetTeams(),", 0);
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
        
        /*
         * We have created a view of the users table called userLogonView. It only has access to username and password colums,
         * if details of the query were exploited only u-name and p-word would be exposed and no other personal information.
         */

        if ($stmt = mysqli_prepare($connection, "SELECT currentTask, COUNT(*) FROM requests WHERE compleate = 0 GROUP BY currentTask")) {
            mysqli_stmt_execute($stmt);
            $resultTeamName = "";
            $requestQty = "";
            mysqli_stmt_bind_result($stmt, $resultTeamName, $requestQty); 
            // taken in as argument()
            $arrayOfTeamNames;
            $arrayOfNamesAndQtys = array();
            // loops through results from query
            while (mysqli_stmt_fetch($stmt)) {
                // adds team name and qty to array with - delimiter
                array_push($arrayOfNamesAndQtys, $resultTeamName."-".$requestQty);
             }
            // 3rd array 
            $teamsAndQTY = array();
            foreach ($arrayOfTeamNames as $i) { 
                $presentInItemFromI = false;
                $teamQty = "";
                foreach ($arrayOfNamesAndQtys as $j) { 
                    if (strpos($j, $i) !== false) {
                        $presentInItemFromI = true;
                        $peicesOfI = explode("-",$j);
                        $teamQty = $peicesOfI[1];
                    }
                }
                if($presentInItemFromI){
                    array_push($teamsAndQTY,$i."-".$teamQty);
                }else{
                    array_push($teamsAndQTY,$i."-0");
                }
            }
            $countOfteamsAndQTY = count($teamsAndQTY);
            echo "[";
            foreach ($teamsAndQTY as $k) { 
                $peicesOfK = explode("-",$k);
                $teamQty = $peicesOfK[1];
                
                echo $teamQty;
                $countOfteamsAndQTY --;
                if(!$countOfteamsAndQTY == 0){
                  echo ", "; 
                }
            }
            echo "],";
            mysqli_stmt_close($stmt);
        }
       mysqli_close($connection);
    }

?>