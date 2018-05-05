<?php

    session_start();
    include("../model/selectModel.php");
    include("../model/insertModel_CompanyReg.php");
    include("../model/updateModel_CompanyReg.php");
    selectConnectionString("../");
    
    /*
     * --------------------- Creates home page for company and validated newCompanyForm.php form --------------------------------
     * - 
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
     
     $UNTRUSTED_cn = $_POST['companyName'];
     $UNTRUSTED_ad = $_POST['address'];
     $UNTRUSTED_ad2 = $_POST['address2'];
     $UNTRUSTED_pc = $_POST['postcode'];
     $UNTRUSTED_cn = $_POST['country'];

    if(empty($UNTRUSTED_cn) || empty($UNTRUSTED_ad) || empty($UNTRUSTED_pc) || empty($UNTRUSTED_cn)){
        $passedRegex = FALSE;
        error_log("failed regex:".$_SESSION['user']."-".$_SESSION['ip'], 0);
        header("Location: newCompanyForm.php?message=char");
        exit();
    }
    
    $subjectName = stripslashes(trim($UNTRUSTED_cn));
    if (preg_match ('%^[A-Za-z0-9\.\' \-!_]{1,20}$%',$subjectName)) {
        $cleanedNamefromForm = escape_data("../",$subjectName);
    } else {
        //If criteria is not met $passedRegex is set to false so the query connection will not open
        $passedRegex = FALSE;
        error_log("failed regex:".$_SESSION['user']."-".$_SESSION['ip'], 0);
        //we redirect the user back to newUser.php but add info to thr URL yo we can read why the user has been sent back and display the correct error messege
        header("Location: newCompanyForm.php?message=char");
        exit();
    }
    
    $subjectAddress = stripslashes(trim($UNTRUSTED_ad));
    if (preg_match ('%^[A-za-z0-9\.\' \-!_&@$~]{1,20}$%', $subjectAddress)) {
        $cleanedAddressfromForm = escape_data("../",$subjectAddress);
    } else {
        error_log("failed regex:".$_SESSION['user']."-".$_SESSION['ip'], 0);
        $passedRegex = FALSE;
        header("Location: newCompanyForm.php?message=char");
        exit();
    }
    
    $subjectAddress2 = stripslashes(trim($UNTRUSTED_ad2));
    if (preg_match ('%^[A-za-z0-9\.\' \-!_&@$~]{1,20}$%', $subjectAddress2)) {
        $cleanedAddress2fromForm = escape_data("../",$subjectAddress2);
    } else {
        error_log("failed regex:".$_SESSION['user']."-".$_SESSION['ip'], 0);
        $passedRegex = FALSE;
        header("Location: newCompanyForm.php?message=char");
        exit();
    }
    
    $subjectPostcode = stripslashes(trim($UNTRUSTED_pc));
    if (preg_match ('%^[A-za-z0-9\.\' \-!_&@.$~]{1,30}$%', $subjectPostcode)) {
        $cleanedPoastcodefromForm = escape_data("../",$subjectPostcode);
    } else {
        error_log("failed regex:".$_SESSION['user']."-".$_SESSION['ip'], 0);
        $passedRegex = FALSE;
        header("Location: newCompanyForm.php?message=char");
        exit();
    }
    
    $subjectCountry = stripslashes(trim($UNTRUSTED_cn));
    if (preg_match ('%^[A-za-z0-9\.\' \-!_&@.$~]{1,30}$%', $subjectCountry)) {
        $cleanedCountryfromForm = escape_data("../",$subjectCountry);
    } else {
        error_log("failed regex:".$_SESSION['user']."-".$_SESSION['ip'], 0);
        $passedRegex = FALSE;
        header("Location: newCompanyForm.php?message=char");
        exit();
    }
    
    /* 
     * Only if the details pass the reggular expressions, $passedRegex remains TRUE and the connection to the DB is run,
     * the sanitised info is then sent to the SQL server
     */
    
   if($passedRegex){
       echo "*passed*";
       
        /*
         * We have created a view of the users table called userCompanyUpdateView. It only has access to username and company colums,
         * 
         * We also see if the user has been flagged as untrusted
         * if they are trusted we run a query and check the results and log annomalys
         * if they are intrusted we start a transaction before each query, check results and roll back if the result is unexpected
         */  
         
        if(isset($_SESSION['unTrustedUser'])){
            echo "untrusted*";
            // insert_prepared_companyUploadTransaction("../",$cleanedNamefromForm,$cleanedAddressfromForm,$cleanedAddress2fromForm,$cleanedPoastcodefromForm,$cleanedCountryfromForm,1);
            // update_prepared_SetCompanyToUserTransaction("../", $_SESSION['user'], $cleanedNamefromForm,1);
        }else{
            // INSERT INTO company (name, address, address2, postcode, country) VALUES (?,?,?,?,?)"
            if(!insert_prepared_companyUpload("../",$cleanedNamefromForm,$cleanedAddressfromForm,$cleanedAddress2fromForm,$cleanedPoastcodefromForm,$cleanedCountryfromForm,1)){
                // if unexpected results untrust user
                // $_SESSION['unTrustedUser'] = true;
                // error_log("user untrusted:".$_SESSION['user']."-".$_SESSION['ip'], 0);
                echo "insert-fail*";
            }else{
                echo "insert-success*";
            }
            // "UPDATE users SET company = ? WHERE username = ?"
            if(update_prepared_SetCompanyToUserTransaction("../", $_SESSION['user'], $cleanedNamefromForm,1)){
                // if unexpected results untrust user
                // $_SESSION['unTrustedUser'] = true;
                // error_log("user untrusted:".$_SESSION['user']."-".$_SESSION['ip'], 0);
                echo "select-fail*";
            }else{
                echo "select-success*";
            }
        }
        
        
        // $_SESSION['company'] = $cleanedNamefromForm;
        // $contents = file_get_contents("../view/vendor/vendorTemplate.php");
        // $file = "dashboard.php";
        // $path = "../view/vendor/".$_SESSION['company'];
        // mkdir($path);
        // chmod($path, 0777); 
        // $filepath = $path."/".$file;
        // file_put_contents($filepath,$contents);
        // chmod($filepath, 0777); 
        
        // header('location: '.$filepath);
        
   }else{
       echo "failed*";
    
        /*
         * the regex on the clientside in JavaScript is the same as the regex on the serverside in PHP
         * if user input fails the regex on the server side it would mean the regex on the client side may have been altered to allow other charicters through
         * this may be a dilberate move by a attacker to introduce potentialy harmful charicters, scripts or querys to the server side
         * if if $passedRegex is false we do not open a connection to the DB
         * we run log.php which records user input, the server and client data and notifies info.pixly
         * we then redirect the user to index.php
         */
         
        header("Location: newCompanyForm.php?message=char");
    
    }


?>