<?php

    session_start();
    include("model/connectionStrings.php");
    
    /*
     * --------------------- Creats home page for company and validated newCompanyForm.php form --------------------------------
     * - 
     * -------------------------------------------------------------------------------------------------------------------------
     */
     
     /*
     *  --Regular Expressions(Regex) are used to check for characters that we dont want entered or that we would not expect to be entered into forms --
     *  We use a custom regular expression for each field as the criteria for each field is different
     *  We run the text through trim() to remove unnessesry whitespace and then stripslashes() to unquote quoted strings.
     *  We use preg_match() to search the text, while validating it using regular expressions
     *  The text is then run through the the escape_data() function *notes in includes/connect.php
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
        header("Location: newCompanyForm.php?mt");
        exit();
    }
    
    $subjectCountry = stripslashes(trim($UNTRUSTED_cn));
    if (preg_match ('%^[A-Za-z0-9\.\' \-!_]{2,20}$%',$subjectCountry)) {
        $cleanedCountryfromForm = escape_data(null,$subjectCountry);
    } else {
        //If criteria is not met $passedRegex is set to false so the query connection will not open
        $passedRegex = FALSE;
        //we redirect the user back to newUser.php but add info to thr URL yo we can read why the user has been sent back and display the correct error messege
        header("Location: newCompanyForm.php?cn");
        exit();
    }
    
    $subjectAddress = stripslashes(trim($UNTRUSTED_ad));
    if (preg_match ('%^[A-za-z0-9\.\' \-!_&@$~]{2,20}$%', $subjectAddress)) {
        $cleanedAddressfromForm = escape_data(null,$subjectAddress);
    } else {
        $passedRegex = FALSE;
        header("Location: newCompanyForm.php?ad");
        exit();
    }
    
    $subjectAddress2 = stripslashes(trim($UNTRUSTED_ad2));
    if (preg_match ('%^[A-za-z0-9\.\' \-!_&@$~]{2,20}$%', $subjectAddress2)) {
        $cleanedAddress2fromForm = escape_data(null,$subjectAddress2);
    } else {
        $passedRegex = FALSE;
        header("Location: newCompanyForm.php?ad2");
        exit();
    }
    
    $subjectPostcode = stripslashes(trim($UNTRUSTED_pc));
    if (preg_match ('%^[A-za-z0-9\.\' \-!_&@.$~]{2,30}$%', $subjectPostcode)) {
        $cleanedPoastcodefromForm = escape_data(null,$subjectPostcode);
    } else {
        $passedRegex = FALSE;
        header("Location: newCompanyForm.php?pc");
        exit();
    }
    
    $subjectCountry = stripslashes(trim($UNTRUSTED_cn));
    if (preg_match ('%^[A-za-z0-9\.\' \-!_&@.$~]{2,30}$%', $subjectCountry)) {
        $cleanedCountryfromForm = escape_data(null,$subjectCountry);
    } else {
        $passedRegex = FALSE;
        header("Location: newCompanyForm.php?cn");
        exit();
    }
    
    /* 
     * Only if the details pass the reggular expressions, $passedRegex remains TRUE and the connection to the DB is run,
     * the sanitised info is then sent to the SQL server
     */
    
   if($passedRegex){
       
        echo "passed";
    
   }


?>