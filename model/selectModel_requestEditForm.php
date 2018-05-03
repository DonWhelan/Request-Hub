<?php


    function select_prepared_requestEditView($dir,$uid) {

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

        if ($stmt = mysqli_prepare($connection, "SELECT name, description, infoForm, currentTask, requestObj FROM portfolios WHERE uid = ?")) {
            mysqli_stmt_bind_param($stmt, "i", $uid);
            mysqli_stmt_execute($stmt);
            $resultName = "";
            $resultDescription = "";
            $reseultinfoForm = "";
            $reseultcurrentTask = "";
            $reseultrequestObj = "";
            $returnArray = "";
            mysqli_stmt_bind_result($stmt, $resultName, $resultDescription, $reseultinfoForm, $reseultcurrentTask, $reseultrequestObj);   
            while (mysqli_stmt_fetch($stmt)) {
                $unserializeArray = unserialize(base64_decode($reseultrequestObj));
                $returnArray = ['name' => $resultName,
                                'description' => $resultDescription, 
                                'infoForm' => $reseultinfoForm, 
                                'currentTask' => $reseultcurrentTask, 
                                'requestObj' => $unserializeArray ];
                return $returnArray;                
            }
            return $returnArray;
            mysqli_stmt_close($stmt);
        }
       mysqli_close($connection);
    }
    
    $returnArray = select_prepared_requestEditView("../",28);
    echo "<pre>";
    print_r($returnArray);

?>