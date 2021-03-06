<?php

    
    function select_prepared_teamRadioButtons($dir,$company) {

        include($dir."../pem/sqlSelect.php");
        $connection = mysqli_connect(sHOST, sUSER, sPASS);
        if (!$connection) {
            trigger_error("Could not reach database!<br/>");
            error_log("Could not connect! select_prepared_teamDropDown(),", 0);
            exit();
        }
        $db_selected = mysqli_select_db($connection, sDB);
        if (!$db_selected) {
            trigger_error("Could not reach database!<br/>");
            error_log("Could not connect! select_prepared_teamDropDown(),", 0);
            exit();
        }
        /* check connection */
        if (mysqli_connect_errno($connection)) {
            error_log("Could not connect! select_prepared_teamDropDown(),", 0);
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
        
        /*
         * We have created a view of the users table called userLogonView. It only has access to username and password colums,
         * if details of the query were exploited only u-name and p-word would be exposed and no other personal information.
         */

        if ($stmt = mysqli_prepare($connection, "SELECT teamName, uid FROM teamsRadioButtons WHERE owningCompany = ?")) {
            mysqli_stmt_bind_param($stmt, "s", $company);
            mysqli_stmt_execute($stmt);
            $resultTeamName = "";
            $resultUid = "";
            mysqli_stmt_bind_result($stmt, $resultTeamName, $resultUid);  
            $counter = 1;
            while (mysqli_stmt_fetch($stmt)) {
                echo "<label><input name='radio".$counter."' type='checkbox' value='".$resultUid."'> ".$resultTeamName."</label>  ";
                echo "<input name='qty' type='hidden' value='".$counter."'>";
                $counter++;
            }

            mysqli_stmt_close($stmt);
        }
       mysqli_close($connection);
    }
    
    function select_prepared_teamRadioButtonsAmend($dir,$teams,$company) {

        include($dir."../pem/sqlSelect.php");
        $connection = mysqli_connect(sHOST, sUSER, sPASS);
        if (!$connection) {
            trigger_error("Could not reach database!<br/>");
            error_log("Could not connect! select_prepared_teamDropDown(),", 0);
            exit();
        }
        $db_selected = mysqli_select_db($connection, sDB);
        if (!$db_selected) {
            trigger_error("Could not reach database!<br/>");
            error_log("Could not connect! select_prepared_teamDropDown(),", 0);
            exit();
        }
        /* check connection */
        if (mysqli_connect_errno($connection)) {
            error_log("Could not connect! select_prepared_teamDropDown(),", 0);
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
        
        /*
         * We have created a view of the users table called userLogonView. It only has access to username and password colums,
         * if details of the query were exploited only u-name and p-word would be exposed and no other personal information.
         */

        if ($stmt = mysqli_prepare($connection, "SELECT teamName, uid FROM teamsRadioButtons WHERE owningCompany = ?")) {
            mysqli_stmt_bind_param($stmt, "s",$company);
            mysqli_stmt_execute($stmt);
            $resultTeamName = "";
            $resultUid = "";
            mysqli_stmt_bind_result($stmt, $resultTeamName, $resultUid);  
            $counter = 1;
            $teamarray = explode(";",$teams);
            while (mysqli_stmt_fetch($stmt)) {
                $checked = "";
                if (in_array($resultUid, $teamarray)){
                    $checked =  "checked='checked'";
                }else{
                    $checked = "";
                }
                echo "<label><input name='radio".$counter."' type='checkbox' ".$checked." value='".$resultUid."'> ".$resultTeamName."</label>  ";
                echo "<input name='qty' type='hidden' value='".$counter."'>";
                $counter++;
            }

            mysqli_stmt_close($stmt);
        }
       mysqli_close($connection);
    }
    
?>