<?php
    session_start();

    /* 
     * ---------------- We take user credentials and validate them to log the user into their account ---------------------
     * There are several steps to this:
     * - Check we have all the nessesery information to check the credentials
     * - Scrub the user data
     * - Check if username is in the 'users' table, retrive the pw-hash and the salt, check the expected results for that query
     * - If it is, we use password_verify() to check if the pepper hashed password and salt match
     * - Create a session for the user
     * - We add the usersname and access level of the user from the DB to the session
     * - We add the IP address of the user to the session
     * - We create a random 25 character long string as a token and add it to the session
     * - We also add the token to a secure/HTTP only cookie and sent it to the clients browser
     * - Finally we direct the user to index.php
     * ---------------------------------------------------------------------------------------------------------------------
     */
    include('../model/selectModel.php');
    include('../model/selectModel_LoginCustomer.php');
    
    //boolean variable used to controle access to the SQL query 
    $passedRegex = TRUE;
    $postUsername = $_POST['username'];
    $postPassword = $_POST['password'];
    $postCompany = $_POST['company'];

    $subjectCompany= $postCompany;
    if (preg_match ('%^[A-Za-z0-9\.\'\-!_]{1,30}$%',$subjectCompany)) {
        $company = escape_data('../',$subjectCompany);
    } else {
        $passedRegex = FALSE;
        error_log("failed regex:".get_client_ip_env(), 0);
        //exit();
    }
    
    /*
     * the "required" class is part of all of the inputs, so the form will not submit without input data
     * If we get input without data its a indication that the HTML on the client side has been altered for we log the error and exit the login script
     * by changing $passedRegex to false, which will not let the connection to the DB open
     */
  
    if(empty($postUsername) || empty($postPassword)){
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

    $subjectUsername = stripslashes(trim($postUsername));
    if (preg_match ('%^[A-Za-z0-9\.\'\-!_]{1,30}$%',$subjectUsername)) {
        $formusername = escape_data("../",$subjectUsername);
    } else {
        //If criteria is not met $passedRegex is set to false so the $formusername will not be sent to the SQL server
        $passedRegex = FALSE;
        error_log("failed regex:".get_client_ip_env(), 0);
       // exit();
    }
    
    // $subjectPassword = stripslashes(trim($postPassword));
    $subjectPassword = $postPassword;
    if (preg_match ('%^[A-Za-z0-9\.\'\-!_]{1,30}$%',$subjectPassword)) {
        $formpassword = escape_data('../',$subjectPassword);
    } else {
        $passedRegex = FALSE;
        error_log("failed regex:".get_client_ip_env(), 0);
        //exit();
    }
    
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
            error_log("user untrusted:".$_SESSION['user']."-".get_client_ip_env(), 0);
            echo "untrusted";
            //SELECT username, password FROM userLogonView WHERE username = '$formusername' LIMIT 1
            $resultArray = select_prepared_customerLogin_transaction($formusername);
        }else{
            // SELECT username, password FROM userLogonView WHERE username = '$formusername' LIMIT 1
            $resultArray = select_prepared_customerLogin($formusername);
        } 

        
        if(empty($resultArray)){
            echo "no such user";
            exit;
        }else{
            $numRows = $resultArray["numRows"];
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
         
        if($numRows > 1){
            // Any unexpected results at this stage in validation we mark the user as untrused 
            // which mean future querys will pass through transactions 
            $_SESSION['unTrustedUser'] = true;
            //logs a security file
            error_log("user untrusted:".$_SESSION['user']."-".$_SESSION['ip'], 0);
            //closed the sql connection
            mysql_close($connection);
            //redirects user index
            header("Location: ../view/vendor/".$company."/login.php?message=incorrect");
            exit();
        }else{
            if(!empty($resultArray["username"]) && !empty($resultArray["username"])){
                $dbUsername = $resultArray["username"];
                $dbPassword = $resultArray["password"];
                $dbSalt = $resultArray["salt"];
                include("../../pem/pepper.php");
                // add salt and pepper
                $password_withSaltAndPepper = pepper.$formpassword.$dbSalt;
                // here the users password is verified from the originally hashed one from the db
                if($formusername == $dbUsername && password_verify($password_withSaltAndPepper, $dbPassword)){
                    echo "signed in";
                    $_SESSION['user'] = $dbUsername;
                    $_SESSION['company'] = $resultArray["company"];
                    // adds the users IP address to the session, this will be used for validation at different stages to stop session hijacking - get_client_ip_env() included from includes/connect.php
                    $_SESSION['ip'] = get_client_ip_env();
                    // adds users browser details
                    $_SESSION['browser'] = $_SERVER['HTTP_USER_AGENT'];
                    // sessions customer
                    $_SESSION['customer'] = true;
                    // random string is created as a ID
                    $randomID = bin2hex(random_bytes(25));
                    // That Id if given to the users session AND also the users cookie, so they can be compaired
                    $_SESSION['cookieId'] = $randomID;
                    //cookies expires within a hour, has a specified path, specifieddomain, are secure flagged, and has HTTP Only flagged
                    setcookie('cookieId', $randomID, time()+3600, "/", "request-hub.com", 1, 1);
 
                   // header("Location: ../view/vendor/".$_SESSION['company']."/dashboard.php");
                   header("Location: ../view/vendor/reports.php");
                    exit();
                }else{
                    header("Location: ../view/vendor/".$company."/login.php?message=incorrect");
                    exit();
                } 
            }else{
                header("Location: ../view/vendor/".$company."/login.php?message=incorrect");
                exit();
            }
            header("Location: ../view/vendor/".$company."/login.php?message=incorrect");
            exit();
        }
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
         header("Location: ../view/vendor/".$company."/login.php?message=incorrect");
    }
?>  
    


