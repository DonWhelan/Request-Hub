
<?php

    function select_prepared_profileShowRequestByUID($dir, $UID, $company) {

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

        if ($stmt = mysqli_prepare($connection, "SELECT name, description, infoForm, currentTask, currentActivity, taskHops, requestObj, compleate FROM requests WHERE uid = ? AND owner = ?")) {
            mysqli_stmt_bind_param($stmt, "ss", $UID, $company);
            mysqli_stmt_execute($stmt);
            $resultName = "";
            $resultDes = "";
            $resultInforForm = "";
            $resultCurrentTask = "";
            $resultCurrentActivity = "";
            $resultTaskHops = "";
            $resultRequestObj = "";
            $resultCompleate = "";
            $resultArray = array();
            mysqli_stmt_bind_result($stmt, $resultName, $resultDes, $resultInforForm, $resultCurrentTask, $resultCurrentActivity, $resultTaskHops, $resultRequestObj, $resultCompleate);
            while (mysqli_stmt_fetch($stmt)) {
                if($resultCompleate == 0){
                    $resultCompleate = "Ongoing";
                }else{
                    $resultCompleate = "Compleate";
                }
                $unserializedResultRequestObj = unserialize(base64_decode($resultRequestObj));
                $resultArray['name'] = $resultName;
                $resultArray['description'] = $resultDes;
                $resultArray['infoForm'] = $resultInforForm;
                $resultArray['currentTask'] = $resultCurrentTask;
                $resultArray['currentActivity'] = $resultCurrentActivity;
                $resultArray['taskHops'] = $resultTaskHops;
                $resultArray['requestObj'] = $unserializedResultRequestObj;
                $resultArray['compleate'] = $resultCompleate;
                return $resultArray;
            }
            mysqli_stmt_close($stmt);
        }
       mysqli_close($connection);
    }
    
?>