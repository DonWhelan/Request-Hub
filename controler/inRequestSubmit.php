<?php
    include('../model/selectModel.php');
    include('../model/insertModel_inRequest.php');
    
    $passedRegex = TRUE;
    $UNTRUSTED_uid = $_POST['uid'];
    $UNTRUSTED_infoForm = $_POST['infoForm'];
    
    if(empty($UNTRUSTED_uid) || empty($UNTRUSTED_infoForm)){
        $passedRegex = FALSE;
        error_log("failed regex:".$_SESSION['user']."-".$_SESSION['ip'], 0);
    }
    
    /*
     *  --Regular Expressions(Regex) are used to check for characters that we dont want entered or that we would not expect to be entered into forms --
     *  We use a custom regular expression for each field as the criteria for each field is different
     *  We run the text through trim() to remove unnessesry whitespace and then stripslashes() to unquote quoted strings.
     *  We use preg_match() to search the text, while validating it using regular expressions
     *  The text is then run through the the escape_data() function *notes in includes/connect.php
     *  //ref: http://www.newthinktank.com/2011/01/php-security/
     */
     
    $subjectUID = stripslashes(trim($UNTRUSTED_uid));
    if (preg_match ('%^[A-Za-z0-9\.\'\-!_]{1,30}$%',$subjectUID)) {
        $uid = escape_data("../",$subjectUID);
    } else {
        //If criteria is not met $passedRegex is set to false so the $formusername will not be sent to the SQL server
        $passedRegex = FALSE;
        error_log("failed regex:".get_client_ip_env(), 0);
        echo "fail1";
        exit();
    }
    
        $subjectInfoForm= stripslashes(trim($UNTRUSTED_infoForm));
        $infoForm = escape_data("../",$subjectInfoForm);

    
    /* 
     * Only if the details pass the reggular expressions, $passedRegex remains TRUE and the connection to the DB is run,
     * The sanitised info is then aloud to be sent to the DB in a query
     */

    if($passedRegex){
        
        /*
         * We have created a view of the users table called userLogonView. It only has access to username and password colums,
         * if details of the query were exploited only u-name and p-word would be exposed and no other personal information.
         * 
         * We also see if the user has been flagged as untrusted
         * if they are trusted we run a query and check the results and log annomalys
         * if they are intrusted we start a transaction before each query, check results and roll back if the result is unexpected
         */ 
         
        if(isset($_SESSION['unTrustedUser'])){
            error_log("user untrusted:".$_SESSION['user']."-".get_client_ip_env()."-select_prepared_userLogin_transaction()", 0);
            echo "untrusted";
            //SELECT username, password FROM userLogonView WHERE username = '$formusername' LIMIT 1
            $numrows = insert_prepared_inRequestAddTransaction("../",$uid,$infoForm,$_SESSION['user'],1);
        }else{
            //insert_prepared_inRequestAdd($dir,$uid, $infoForm, $submitter, $expectedResult)
            $numrows = insert_prepared_inRequestAdd("../",$uid,$infoForm,$_SESSION['user'],1);
        } 

        /*
         * mysqli_query() was chosen over the other connection functions as it only allows one query to be sent to the DB
         * if a second query was introduced via SLQ injection the second query would not exacute 
         */

        /*
         * Before each user can set up account, there chosen username is checked against the DB to ensure that it is unique, so the username becomes a unique identifier
         * Because of this a username query should only have 0 or 1 row effected
         * If more than 1 row is effected that is a indication that SQL could have been injected into query to the DB
         * So we create a security log by calling "/log/logMail.php" and notifies info.pixly --- notes on this script in file
         * this recored all the current server info, client info and what text was entered into the input fields
         * this can then be reviewed in detail to see it was a potential attacker and if we want to blacklist the IP from the server
         * the sql connection is closed and the user redirected
         */
         
         if($numrows > 1){
            $_SESSION['unTrustedUser'] = true;
         }
         
         header("Location: ../../view/vendor/reports.php");
         
    
    //if $passedRegex is false .ie if we get any unexpected data from the user   
    }else{
        
        /*
         * the regex on the clientside in JavaScript is the same as the regex on the serverside in PHP
         * if user input fails the regex on the server side it would mean the regex on the client side may have been altered to allow other charicters through
         * this may be a dilberate move by a attacker to introduce potentialy harmful charicters, scripts or querys to the server side
         * if $passedRegex is false we do not open a connection to the DB
         * we run log.php which records user input, the server and client data
         * we then redirect the user to failedLogin.php
         */
         
         error_log("user untrusted:".$_SESSION['user']."-".$_SESSION['ip'], 0);
         header("Location: ../view/userLogin.php?message=incorrect");
    }

?>