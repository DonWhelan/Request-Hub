<?php
    /*
     * -------------------------In newuser.php we create new user profiles----------------------------------------------------
     * - user input is sanitised 
     * - passwords are hashed 
     * - Check if the user name is in the 'users' table on the the DB, and check the expected results from query to the DB
     * - if the username is free, write the user details to the DB, and check the expected results from write to the DB
     * - Create a session for the user
     * - We add the usersname and access level of the user from the DB to the session
     * - We add the IP address of the user to the session
     * - We create a random 25 character long string as a token and add it to the session
     * - We also add the token to a secure/HTTP only cookie and sent it to the clients browser
     * - Create a file named after the username and write the PHP template code to the profile page
     * - save the file to the profiles directory
     * - Redirect the user their new profile page
     * -------------------------------------------------------------------------------------------------------------------------
     */
    
    session_start();
    include("../model/connectionStrings.php");

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
     
     $un = $_POST['username'];
     $pw = $_POST['password'];
     $pwm = $_POST['passwordmatch'];
     $em = $_POST['email'];

    if(empty($un) || empty($pw) || empty($pwm) || empty($em)){
        error_log("failed regex:".$_SESSION['user']."-".$_SESSION['ip'], 0);
        $passedRegex = FALSE;
        header("Location: ../view/userRegister.php?un");
        exit();
    }
    
    if($pw != $pwm){
        error_log("failed regex:".$_SESSION['user']."-".$_SESSION['ip'], 0);
       header("Location: ../view/userRegister.php?pw");
       exit();
    }
    
    $subjectUsername = stripslashes(trim($un));
    if (preg_match ('%^[A-Za-z0-9\.\' \-!_]{1,20}$%',$subjectUsername)) {
        $username = escape_data('../',$subjectUsername);
    } else {
        error_log("failed regex:".$_SESSION['user']."-".$_SESSION['ip'], 0);
        //If criteria is not met $passedRegex is set to false so the query connection will not open
        $passedRegex = FALSE;
        //we redirect the user back to newUser.php but add info to thr URL yo we can read why the user has been sent back and display the correct error messege
        header("Location: ../view/userRegister.php?un");
        exit();
    }
    
    $subjectPassword = stripslashes(trim($pw));
    if (preg_match ('%^[A-za-z0-9\.\' \-!_&@$~]{1,20}$%', $subjectPassword)) {
        $password = escape_data('../',$subjectPassword);
    } else {
        error_log("failed regex:".$_SESSION['user']."-".$_SESSION['ip'], 0);
        $passedRegex = FALSE;
        header("Location: ../view/userRegister.php?pw");
        exit();
    }
    
    $subjectPasswordm = stripslashes(trim($pwm));
    if (preg_match ('%^[A-za-z0-9\.\' \-!_&@$~]{1,20}$%', $subjectPasswordm)) {
        $passwordm = escape_data('../',$subjectPasswordm);
    } else {
        error_log("failed regex:".$_SESSION['user']."-".$_SESSION['ip'], 0);
        $passedRegex = FALSE;
        header("Location: ../view/userRegister.php?pw");
        exit();
    }
    
    $subjectEmail = stripslashes(trim($em));
    if (preg_match ('%^[A-za-z0-9\.\' \-!_&@.$~]{1,30}$%', $subjectEmail)) {
        $email = escape_data('../',$subjectEmail);
    } else {
        error_log("failed regex:".$_SESSION['user']."-".$_SESSION['ip'], 0);
        $passedRegex = FALSE;
        header("Location: ../view/userRegister.php?em");
        exit();
    }
    
    /* 
     * Only if the details pass the reggular expressions, $passedRegex remains TRUE and the connection to the DB is run,
     * the sanitised info is then sent to the SQL server
     */
    
   if($passedRegex){
        /*
         * We run a query to see if the username is already registered in the DB
         */
        $arr[] = "";
        // select_sqliLog_max1_Rnum returns a sql result object and num of rows affected from the query
        // userUsernameView is a view of users that only shows username
        $arr = select_sqliLog_max1_Rnum('../',"SELECT username FROM userUsernameView WHERE username = '$username' LIMIT 1",1);   
        
        /*
         * mysqli_query() was chosen over the other connection functions as it only allows one query to be sent to the DB
         * if a second query was introduced via SLQ injection the second query would not exacute 
         */

        $result =  $arr[0];
        $numRows = $arr[1];
        //$result = mysql_query($query); 
        //$numRows = mysql_num_rows($result);
        
        //variable to mark if the username is free or not
        $UserNameFree = true;
        
        /*
         * Before each user can set up account, there chosen username is checked against the DB to ensure that it is unique, so the username becomes a unique identifier
         * Because of this a username query, should only have 1 or 0 row effected
         * If more than 1 row is effected that is a indication that SQL could have been injected into query to the DB and is effecting multible rows
         * So we create a security log by calling "/log/logmail.php" --- notes on this script in file
         * As as intruder could potentialy have penatrated as far as the SQL connection a mail is sent to the Pixly admin to notify them
         * "/log/logmail.php" records all the current server info, client info and what text was entered into the input fields
         * this can then be reviewed in detail to see it was a potential attacker and if we want to blacklist the IP from the server
         */
        
        if($numRows > 1){
            //logs a security file
            error_log("user untrusted:".$_SESSION['user']."-".$_SESSION['ip'], 0);
            //closed the sql connection
            mysql_close($connection);
            //redirects user index
            header("Location: ../view/userRegister.php?rf");
            
        }else{
            
            /*
             * else 1 or 0 rows are effected is the expected result so we check if the user name matches any existing usernames
             */
            $dbUsername = "";
            while ($row = mysqli_fetch_assoc($result)) {
                $dbUsername=$row['username'];
                //if there is a match we redirect to newUser with userE in the url, we can then read that and display the correct error for the user
                if($username == $dbUsername){
                    //we mark the username as not free
                    $UserNameFree = false;
                    header("Location: ../view/userRegister.php?error");
                    exit();
                }
            }
        } 
           
        /*
         * --If the username is free--
         * we then log the user details to the DB
         * create a session for the user
         * write a profile file to the directory
         * and redirect the user to the new profile
         */
        
        if($UserNameFree){
            
            /*
             * password_hash() was picked over MD5 as its outdated and unsecure and SHA1 as it dosnt provide the cost functinality that password_hash() does which will defend against brute force attacks
             * password_hash() returns the algorithm, cost and salt as part of the returned hash. Therefore, 
             * all information that's needed to verify the hash is included in it. 
             * This allows the verify function to verify the hash without needing separate storage for the salt or algorithm information.
             * password_hash() also allows us to use Blowfish encryption
             */
            
            // brings in pepper which is a defined variable outside the web root
            include("../../pem/pepper.php");
            // salt generated
            $salt = bin2hex(random_bytes(25));
            // adds peper and salt to the password
            $password_withSaltAndPepper = pepper.$password.$salt;
             
            $userpasswordhashed = password_hash($password_withSaltAndPepper , CRYPT_BLOWFISH,['cost' => 8]);
            
            //we then log the user details to the DB
            //echo "hello friends";
            insert_sqli('../',"INSERT INTO users (username, password, email, salt) VALUES ('$username','$userpasswordhashed','$email','$salt')");
            
            $_SESSION['user'] = $username;
            // adds the users IP address to the session, this will be used for validation at different stages to stop session hijacking - get_client_ip_env() included from includes/connect.php
            $_SESSION['ip'] = get_client_ip_env();
            // adds users browser details
            $_SESSION['browser'] = $_SERVER['HTTP_USER_AGENT'];
            // random string is created as a ID
            $randomID = bin2hex(random_bytes(25));
            // That Id if given to the users session AND also the users cookie, so they can be compaired
            $_SESSION['cookieId'] = $randomID;
            //cookies expires within a hour, has a specified path, specifieddomain, are secure flagged, and has HTTP Only flagged
            setcookie('cookieId', $randomID, time()+3600, "/", "request-hub.com", 1, 1);
            echo "new user created";
            //user then directed to their new profile
            header("Location: ../view/newCompanyForm.php");
        }
   }else{
    
        /*
         * the regex on the clientside in JavaScript is the same as the regex on the serverside in PHP
         * if user input fails the regex on the server side it would mean the regex on the client side may have been altered to allow other charicters through
         * this may be a dilberate move by a attacker to introduce potentialy harmful charicters, scripts or querys to the server side
         * if if $passedRegex is false we do not open a connection to the DB
         * we run log.php which records user input, the server and client data and notifies info.pixly
         * we then redirect the user to index.php
         */
     
        header("Location: ../view/userRegister.php?error");
    }   
            
?>