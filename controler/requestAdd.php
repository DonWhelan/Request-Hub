<?php

    session_start();
    include("../model/selectModel.php");
    include("../model/insertModel_requestAddTasks.php");
    //include("../model/insertModel_teamNew.php");
    selectConnectionString("../");
    
    /*
     * --------------------- Creates home page for company and validated newCompanyForm.php form --------------------------------
     * - includes models
     * - takes data from form 
     * - passes through escape_data() to escape sql and html
     * - checks if user is trusted 
     * - if trused creates form
     * - if not trusted creates a transaction and then inserts team
     * - directes us back to request page
     * -------------------------------------------------------------------------------------------------------------------------
     */

     /*
     *  --Regular Expressions(Regex) are used to check for characters that we dont want entered or that we would not expect to be entered into forms --
     *  We use a custom regular expression for each field as the criteria for each field is different
     *  We run the text through trim() to remove unnessesry whitespace and then stripslashes() to unquote quoted strings.
     *  We use preg_match() to search the text, while validating it using regular expressions
     *  The text is then run through the the escape_data() function
     */
        
    //boolean variable used to trigger the SQL query
    $passedRegex = TRUE;
    
    /*
     * the "required" class is part of all of the inputs, so the form will not submit without input data
     * If we get input without data its a indication that the HTML on the client side has been altered for we log the error and exit the login script
     * by changing $passedRegex to false, which will not let the connection to the DB open
     */
         
         
    $qtyoftasks = "";
    $qtyoftasks = $_POST['qty'];
    $reqName = "";
    $reqName = $_POST['reqName'];
    $dis = "";
    $dis = $_POST['dis'];
    $infoForm = "";
    $infoForm = $_POST['infoForm'];
    
    if(empty($qtyoftasks)){
        error_log("failed regex:".$_SESSION['user']."-".$_SESSION['ip'], 0);
        $passedRegex = FALSE;
        header('location: ../view/vendor/requestAdd.php?test');
        exit();
    } 
    
    if(is_int($qtyoftasks)){
        error_log("failed regex:".$_SESSION['user']."-".$_SESSION['ip'], 0);
        header('location: ../view/vendor/requestAdd.php?test');
    }

    $qtyoftasks = stripslashes(trim($qtyoftasks));
    if (preg_match ('%^[0-9]{1,50}$%',$qtyoftasks)) {
        $cleaned_qtyoftasks = escape_data("../",$qtyoftasks);
    } else {
        error_log("failed regex:".$_SESSION['user']."-".$_SESSION['ip'], 0);
        //If criteria is not met $passedRegex is set to false so the query connection will not open
        $passedRegex = FALSE;
        //we redirect the user back to newUser.php but add info to thr URL yo we can read why the user has been sent back and display the correct error messege
        header("Location: ../view/vendor/request.php?message=teamError1");
        exit();
    }
    
    $cleaned_qtyoftasks --;
    $request = array("totalTasks" => $cleaned_qtyoftasks, "tasks" => array());
    for ($x = 0; $x <= $cleaned_qtyoftasks; $x++) {
        
        $UNTRUSTED_team = $_POST['Team'.$x];
        $UNTRUSTED_action = $_POST['action'.$x];
        
        $formteam = stripslashes(trim($UNTRUSTED_team));
        if (preg_match ('%^[A-Za-z0-9\.\' \-!_]{1,500}$%',$formteam)) {
            $cleaned_team = escape_data("../",$formteam);
        } else {
            error_log("failed regex:".$_SESSION['user']."-".$_SESSION['ip'], 0);
            //If criteria is not met $passedRegex is set to false so the query connection will not open
            $passedRegex = FALSE;
            //we redirect the user back to newUser.php but add info to thr URL yo we can read why the user has been sent back and display the correct error messege
            header("Location: ../view/vendor/request.php?message=teamError2");
            exit();
        }
        
        $formaction = stripslashes(trim($UNTRUSTED_action));
        if (preg_match ('%^[A-Za-z0-9\.\' \-!_]{1,500}$%',$formaction)) {
            $cleaned_action = escape_data("../",$formaction);
        } else {
            error_log("failed regex:".$_SESSION['user']."-".$_SESSION['ip'], 0);
            //If criteria is not met $passedRegex is set to false so the query connection will not open
            $passedRegex = FALSE;
            //we redirect the user back to newUser.php but add info to thr URL yo we can read why the user has been sent back and display the correct error messege
            header("Location: ../view/vendor/request.php?message=teamError3");
            exit();
        }

        $request['tasks']['team'.$x] = $cleaned_team;
        $request['tasks']['action'.$x] = $cleaned_action;
        
    }
    
    /* 
     * Only if the details pass the reggular expressions, $passedRegex remains TRUE and the connection to the DB is run,
     * the sanitised info is then sent to the SQL server
     */
    
    if($passedRegex){

        /*
         * We also see if the user has been flagged as untrusted
         * if they are trusted we run a query and check the results and log annomalys
         * if they are intrusted we start a transaction before each query, check results and roll back if the result is unexpected
         */  
         
        $SerializedRequestArray = base64_encode(serialize($request));

        //$testarray = unserialize(base64_decode($YourSerializedData));
        
        if(isset($_SESSION['unTrustedUser'])){
            // $dir, $owner, $currentTask, $requestObj, $expectedResult
            insert_prepared_requestTeamsAndTasksTransaction("../", $_SESSION['company'], $reqName, $dis, $infoForm, $request['tasks']['team0'], $SerializedRequestArray,1);
        }else{
            // INSERT INTO portfolios (owner, currentTask, requestObj) VALUES (?,?,?)
            if(!insert_prepared_requestTeamsAndTasks("../", $_SESSION['company'], $reqName, $dis, $infoForm, $request['tasks']['team0'], $SerializedRequestArray,1)){
                // if unexpected results untrust user
                error_log("user untrusted:".$_SESSION['user']."-".$_SESSION['ip'], 0);
                $_SESSION['unTrustedUser'] = true;
            }
        }
        
        header("Location: ../view/vendor/request.php?message=reqSucess");
        
    }else{
    
        /*
         * the regex on the clientside in JavaScript is the same as the regex on the serverside in PHP
         * if user input fails the regex on the server side it would mean the regex on the client side may have been altered to allow other charicters through
         * this may be a dilberate move by a attacker to introduce potentialy harmful charicters, scripts or querys to the server side
         * if if $passedRegex is false we do not open a connection to the DB
         * we run log.php which records user input, the server and client data and notifies info.pixly
         * we then redirect the user to index.php
         */
         
        header("Location: ../view/vendor/request.php?message=teamError4");
    
    }


?>