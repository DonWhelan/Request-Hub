<?php

    session_start();
    include("../model/selectModel.php");
    include("../model/insertModel_teamNew.php");
    selectConnectionString("../");
    
    /*
     * --------------------- Creates home page for company and validated newCompanyForm.php form --------------------------------
     * - includes models
     * - takes data from form 
     * - passes through escape_data() to escape sql and html
     * - checks if user is trusted 
     * - if trused inserts team
     * - if not trusted creates a transaction and then inserts team
     * - directes us back to team page
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
     
     $UNTRUSTED_tn = $_POST['teamName'];
     $UNTRUSTED_rl = $_POST['role'];


    if(empty($UNTRUSTED_tn) || empty($UNTRUSTED_rl)){
        error_log("failed regex:".$_SESSION['user']."-".$_SESSION['ip'], 0);
        $passedRegex = FALSE;
        header("Location: ../view/vendor/team.php?message=teamError");
        exit();
    }
    
    $subjectName = stripslashes(trim($UNTRUSTED_tn));
    if (preg_match ('%^[A-Za-z0-9\.\' \-!_]{2,500}$%',$subjectName)) {
        $cleanedNamefromForm = escape_data("../",$subjectName);
    } else {
        error_log("failed regex:".$_SESSION['user']."-".$_SESSION['ip'], 0);
        //If criteria is not met $passedRegex is set to false so the query connection will not open
        $passedRegex = FALSE;
        //we redirect the user back to newUser.php but add info to thr URL yo we can read why the user has been sent back and display the correct error messege
        header("Location: ../view/vendor/team.php?message=teamError");
        exit();
    }
    
    $subjectRole = stripslashes(trim($UNTRUSTED_rl));
    if (preg_match ('%^[A-Za-z0-9\.\' \-!_]{2,500}$%',$subjectName)) {
        $cleanedRolefromForm = escape_data("../",$subjectRole);
    } else {
        error_log("failed regex:".$_SESSION['user']."-".$_SESSION['ip'], 0);
        $passedRegex = FALSE;
        header("Location: ../view/vendor/team.php?message=teamError");
        exit();
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

        if(isset($_SESSION['unTrustedUser'])){
            insert_prepared_teamNewTransaction("../",$cleanedNamefromForm,$cleanedRolefromForm,$_SESSION['company'],1);
        }else{
            // INSERT INTO company (name, address, address2, postcode, country) VALUES (?,?,?,?,?)"
            if(!insert_prepared_teamNew("../",$cleanedNamefromForm,$cleanedRolefromForm,$_SESSION['company'],1)){
               // if unexpected results untrust user
               error_log("user untrusted:".$_SESSION['user']."-".$_SESSION['ip'], 0);
                $_SESSION['unTrustedUser'] = true;
            }
        }
        
        header("Location: ../view/vendor/team.php?message=success");
        
   }else{
    
        /*
         * the regex on the clientside in JavaScript is the same as the regex on the serverside in PHP
         * if user input fails the regex on the server side it would mean the regex on the client side may have been altered to allow other charicters through
         * this may be a dilberate move by a attacker to introduce potentialy harmful charicters, scripts or querys to the server side
         * if if $passedRegex is false we do not open a connection to the DB
         * we run log.php which records user input, the server and client data and notifies info.pixly
         * we then redirect the user to index.php
         */
         
        header("Location: ../view/vendor/team.php?message=teamError");
    
    }


?>