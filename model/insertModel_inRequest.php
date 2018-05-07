<?php

session_start();

    /*
     *   insert_prepared_imageUpload takes 6 arguments and querys a prepaired statment to call images
     *   exacutes the query and the takes the affeted rows
     *   checks the affected rows agains the expected rows
     *   returns true if affected rows are equal expected rows they match, and false if not
     */     
    
    function insert_prepared_inRequestAdd($dir,$uid, $infoForm, $submitter, $expectedResult,$imID) {
        // connection details are stored outside the web directory and are defined
        $goodResult = true; 
        include($dir."../pem/sqlInsert.php");
        $connection = mysqli_connect(iHOST, iUSER, iPASS);
        if (!$connection) {
            trigger_error("Could not reach database!<br/>");
            error_log("unable to connect! insert_prepared_inRequestAdd(),", 0);
            exit();
        }
        $db_selected = mysqli_select_db($connection, iDB);
        if (!$db_selected) {
            trigger_error("Could not reach database!<br/>");
            error_log("unable to connect! insert_prepared_inRequestAdd(),", 0);
            exit();
        } 
        // Check connection
        if ($connection->connect_error) {
            error_log("unable to connect! insert_prepared_inRequestAdd(),", 0);
            die("Connection failed: " . $connection->connect_error);
        }
        
        $owner = "";
        $name = "";
        $description = "";
        $currentTask = "";
        $requestObj = ""; 
        
        if ($Sstmt = mysqli_prepare($connection, "SELECT owner, name, description, currentTask, requestObj FROM portfolios WHERE uid = ? LIMIT 1")) {
            /* bind parameters for markers */
            mysqli_stmt_bind_param($Sstmt, "s", $uid);
            /* execute query */
            mysqli_stmt_execute($Sstmt);
            /* bind result variables */
            mysqli_stmt_bind_result($Sstmt, $Rowner, $Rname, $Rdescription, $RcurrentTask, $RrequestObj);
            /* fetch value */
            while (mysqli_stmt_fetch($Sstmt)) {
                $owner = $Rowner;
                $name = $Rname;
                $description = $Rdescription;
                $currentTask = $RcurrentTask;
                $requestObj = $RrequestObj; 
            }
            $affectedRows = $Sstmt->num_rows;
            if($affectedRows != $expectedResult){
                error_log("unexpected result! insert_prepared_inRequestAdd(),", 0);
                $goodResult = false;
            }
        }  
        
        // echo "owner: ".$owner."<br>";
        // echo "name: ".$name."<br>";
        // echo "submitter: ".$submitter."<br>";
        // echo "description: ".$description."<br>";
        // echo "infoForm: ".$infoForm."<br>";
        // echo "currentTask: ".$currentTask."<br>";
        // echo "requestObj: ".$requestObj."<br>";
        //echo "<pre>";
        
        $arrayFromRequest = unserialize(base64_decode($requestObj));
        $currentActivity = $arrayFromRequest['tasks']['action0'];
        
        
        $Istmt = $connection->prepare("INSERT INTO requests (owner, name, submitter, description, infoForm, currentTask, currentActivity, requestObj, imageID) VALUES (?,?,?,?,?,?,?,?,?)");
        $Istmt->bind_param("sssssssss", $owner, $name, $submitter, $description, $infoForm, $currentTask, $currentActivity, $requestObj, $imID);
        var_dump($Istmt->execute());
        $affectedRows = mysqli_stmt_affected_rows($Istmt);
        // check expected result
        if($affectedRows != $expectedResult){
            error_log("unexpected result! insert_prepared_inRequestAdd(),", 0);
            $goodResult = false;            
            echo "bad";
            return $affectedRows;
        }else{
            echo "good";
            return $affectedRows;
        }
    } 

    function insert_prepared_inRequestAddTransaction($dir,$uid, $infoForm, $submitter, $expectedResult,$imID) {
        // connection details are stored outside the web directory and are defined
        $goodResult = true; 
        include($dir."../pem/sqlInsert.php");
        $connection = mysqli_connect(iHOST, iUSER, iPASS);
        if (!$connection) {
            trigger_error("Could not reach database!<br/>");
            error_log("unable to connect! insert_prepared_inRequestAdd(),", 0);
            exit();
        }
        $db_selected = mysqli_select_db($connection, iDB);
        if (!$db_selected) {
            trigger_error("Could not reach database!<br/>");
            error_log("unable to connect! insert_prepared_inRequestAdd(),", 0);
            exit();
        } 
        // Check connection
        if ($connection->connect_error) {
            error_log("unable to connect! insert_prepared_inRequestAdd(),", 0);
            die("Connection failed: " . $connection->connect_error);
        }
        
        // alows transactions
        mysqli_autocommit($connection,FALSE);
        // starts transaction
        mysqli_query($connection,"start transaction");
        
        $owner = "";
        $name = "";
        $description = "";
        $currentTask = "";
        $requestObj = ""; 
        
        if ($Sstmt = mysqli_prepare($connection, "SELECT owner, name, description, currentTask, requestObj FROM portfolios WHERE uid = ? LIMIT 1")) {
            /* bind parameters for markers */
            mysqli_stmt_bind_param($Sstmt, "s", $uid);
            /* execute query */
            mysqli_stmt_execute($Sstmt);
            /* bind result variables */
            mysqli_stmt_bind_result($Sstmt, $Rowner, $Rname, $Rdescription, $RcurrentTask, $RrequestObj);
            /* fetch value */
            while (mysqli_stmt_fetch($Sstmt)) {
                $owner = $Rowner;
                $name = $Rname;
                $description = $Rdescription;
                $currentTask = $RcurrentTask;
                $requestObj = $RrequestObj; 
            }
            $affectedRows = $Sstmt->num_rows;
            if($affectedRows != $expectedResult){
                error_log("unexpected result! insert_prepared_inRequestAdd(),", 0);
                $goodResult = false;
                mysqli_query($connection,"rollback");
            }
        }    
        
        $Istmt = $connection->prepare("INSERT INTO requests (owner, name, submitter, description, infoForm, currentTask, requestObj, imageID) VALUES (?,?,?,?,?,?,?,?)");
        $Istmt->bind_param("sssssss", $owner, $name, $submitter, $description, $infoForm, $currentTask, $requestObj, $imID);
        $Istmt->execute();
        $affectedRows = mysqli_stmt_affected_rows($Istmt);
        // check expected result
        echo $affectedRows.":".$expectedResult;
        if($affectedRows != $expectedResult){
            error_log("unexpected result! insert_prepared_inRequestAdd(),", 0);
            $goodResult = false;
            mysqli_query($connection,"rollback");
            return $affectedRows;
        }else{
            mysqli_query($connection,"commit");
            return $affectedRows;
        }
    } 
    
?>