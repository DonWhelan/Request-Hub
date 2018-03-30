<?php
    /* --------------------- This file containes functions to safley handle querys to the mySql DB ----------------------------
     * There are seperate connection strings for SELECT INSERT UPDATE and DELETE
     * Each connection string is set up with its own individual account on the mySQL server with individual access levels
     * There is a function to retrive clicent IP addresses and a function to escape user text input before sending to the DB
     * There are 3 functions for each statement that have 3 levels security
     * ------------------------------------------------------------------------------------------------------------------------
     */
    
   /* 
    * mysql db engine must be set to innodb and not myisam as myisam does not have transactionality enabled
    * Referances:
    * https://dev.mysql.com/doc/refman/5.7/en/myisam-storage-engine.html
    * https://dev.mysql.com/doc/refman/5.7/en/innodb-introduction.html
    */
    
    /* - CONNECTION STRINGS - 
     * DB details are defined as constants rather than variables, to stop values from being altered.
     * mysqli functions are used over mysql functions
     * mysqli supports Multiple Statements, Stored Procedures, server-side Prepared Statements, Charsets. Mysqli It is also recommended for new projects by MySQL 
     * The credentials in each ConnectionString() only have the permissions to perform the query its designed to do on the mysql server
     * 
     * Referances:
     * http://php.net/manual/en/mysqli.overview.php
     * http://www.php.net/manual/en/mysqlinfo.library.choosing.php
     * http://php.net/manual/en/mysqlinfo.api.choosing.php
     * http://php.net/manual/en/function.define.php
     * http://www.newthinktank.com/2011/01/web-design-and-programming-pt-21-secure-login-script/
     */
     
    // masterConnectionString() only has full root permission on its account on the MYSQL Server. 
    function masterConnectionString($dir){
        /* connection details are stored outside the web directory so they cannot be navigated to and are defined
         *
         *    www
         *     |
         *     +-- pem
         *     |    |-- sqlMaster.php 
         *     |    |-- sqlSelect.php
         *     |    |-- sqlInsert.php
         *     |    |-- sqlUpdate.php
         *     |    |-- sqlDelete.php
         *     |    
         *     +-- HTML(web root)
         *          |-- index.php
         *
         */
        include($dir."../pem/sqlMaster.php");
        $connection = mysqli_connect(mHOST, mUSER, mPASS);
        if (!$connection) {
            trigger_error("Could not reach database!<br/>");
            exit();
        }
        $db_selected = mysqli_select_db($connection, mDB);
        if (!$db_selected) {
            trigger_error("Could not reach database!<br/>");
            exit();
        } 
        return $connection;
    }
    
    // selectConnectionString() only has SELECT permission on its account on the MYSQL Server.
    function selectConnectionString($dir){
        // connection details are stored outside the web directory and are defined
        include($dir."../pem/sqlSelect.php");
        $connection = mysqli_connect(sHOST, sUSER, sPASS);
        if (!$connection) {
            trigger_error("Could not reach database!<br/>");
            include("logs/logsMail-1dir.php");
            exit();
        }
        $db_selected = mysqli_select_db($connection, sDB);
        if (!$db_selected) {
            trigger_error("Could not reach database!<br/>");
            include("logs/logsMail-1dir.php");
            exit();
        } 
        return $connection;
    }
    
    // insertConnectionString() only has SELECT INSERT permission on its account on the MYSQL Server.    
    function insertConnectionString($dir){
        // connection details are stored outside the web directory and are defined
        include($dir."../pem/sqlInsert.php");
        $connection = mysqli_connect(iHOST, iUSER, iPASS);
        if (!$connection) {
            trigger_error("Could not reach database!<br/>");
            include("logs/logsMail-1dir.php");
            exit();
        }
        $db_selected = mysqli_select_db($connection, iDB);
        if (!$db_selected) {
            trigger_error("Could not reach database!<br/>");
            include("logs/logsMail-1dir.php");
            exit();
        } 
        return $connection;
    }
    
    // updateConnectionString() only has SELECT and UPDATE permission on its account on the MYSQL Server.  
    function updateConnectionString($dir){
        // connection details are stored outside the web directory and are defined
        include($dir."../pem/sqlUpdate.php");
        $connection = mysqli_connect(uHOST, uUSER, uPASS);
        if (!$connection) {
            trigger_error("Could not reach database!<br/>");
            include("logs/logsMail-1dir.php");
            exit();
        }
        $db_selected = mysqli_select_db($connection, uDB);
        if (!$db_selected) {
            trigger_error("Could not reach database!<br/>");
            include("logs/logsMail-1dir.php");
            exit();
        } 
        return $connection;
    }
    
    // deleteConnectionString() only has SELECT and DELETE permission on its account on the MYSQL Server.      
    function deleteConnectionString($dir){
        // connection details are stored outside the web directory and are defined
        include($dir."../pem/sqlDelete.php");
        $connection = mysqli_connect(dHOST, dUSER, dPASS);
        if (!$connection) {
            trigger_error("Could not reach database!<br/>");
            include("logs/logsMail-1dir.php");
            exit();
        }
        $db_selected = mysqli_select_db($connection, dDB);
        if (!$db_selected) {
            trigger_error("Could not reach database!<br/>");
            include("logs/logsMail-1dir.php");
            exit();
        } 
        return $connection;
    }    
    
    /*  - ESCAPE_DATA() - 
     *  escape_data function strips text that is being sent to the DB of harmful tags and characters
     *  mysqli_real_escape_string() is a more secure method of scrubbing data so we check if it is available, as it rely's on a connection to the DB
     *  If available we trim() to remove whitespace, then put pass through the mysql_real_escape_string() to address the threat of SQL injection.
     *  The data is then run through strip_tags() to remove HTML tags like "<script>" to address XSS attacks.
     *  If mysqli_real_escape_string() in unavailable we do the same steps but using mysql_escape_string().
     *  This function should be used for all text sent to the DB or files on the web/file directory!
     *  
     *  Referances:
     *  http://www.newthinktank.com/2011/01/php-security/
     */
     
    function escape_data($dir,$dataFromForms) {
        $conn = selectConnectionString($dir);
        if (function_exists('mysql_real_escape_string')) {
            $dataFromForms = mysqli_real_escape_string (trim($dataFromForms), $connection);
            $dataFromForms = strip_tags($dataFromForms);
        } else {
            $dataFromForms = mysqli_escape_string ( $conn, (trim($dataFromForms)));
            $dataFromForms = strip_tags($dataFromForms);
        }
        return $dataFromForms;
    }
    
    /*  - get_client_ip_env() -
     *  This function returns the client ip address
     *  this function is called when querys on the DB do not behave as expected 
     *
     *  Referances:
     *  https://www.virendrachandak.com/techtalk/getting-real-client-ip-address-in-php-2/
     */
     
    function get_client_ip_env() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
    
    /*  ---------- SELECT Functions ---------- //
     *  select_sqli(), select_sqliLog() and select_sqliTransaction() all use selectConnectionString() which has SELECT and LOCK only access to the DB
     *  each one takes in a SQL query as a argument and handles faild connections to the db server and the database its self
     */    
    
    //  select_sqli() passes a Select query to the DB with no checks on how that query effects the DB 
    function select_sqli($dir,$select_query) {
        $connection = selectConnectionString($dir);
        $queryresult = mysqli_query($connection, $select_query); 
        if (! $queryresult){
            echo('Database error: ' . mysqli_error($connection));
            exit;
        }
        mysqli_close($connection);
        return $queryresult;
    }
    
    /* 
     *   select_sqliLog() takes 2 arguments the query and the expected amount of rows affected from that query
     *   if the effected number of rows does not match the what is thought, a security logs is created 
     */
     
    function select_sqliLog($dir,$select_query,$expectedResult) {
        $connection = selectConnectionString($dir);
        $queryresult = mysqli_query($connection, $select_query); 
        $numRows = mysqli_affected_rows($connection);
        if (! $queryresult){
            echo('Database error: ' . mysqli_error($connection));
            exit;
        }   
        if($numRows != $expectedResult){
            include("logs/logsMail.php");
        }
        mysqli_close($connection);
        return $queryresult;
    }
    
    /* 
     *   select_sqliLog() takes 2 arguments the query and the expected amount of rows affected from that query
     *   if the effected number of rows does not match the what is thought, a security logs is created 
     */
     
    function select_sqliLog_max1_Rnum($dir,$select_query,$expectedResult) {
        $connection = selectConnectionString($dir);
        $queryresult = mysqli_query($connection, $select_query); 
        $numRows = mysqli_affected_rows($connection);
        if (! $queryresult){
            echo('Database error: ' . mysqli_error($connection));
            exit;
        }   
        if($numRows > $expectedResult){
            include("logs/logsMail.php");
        }
        mysqli_close($connection);
        
        $array = array($queryresult, $numRows);
        return $array;
        //return $queryresult;
    }
    
    /*
     *   select_sqliTransaction() takes 2 arguments the query and the expected amount of rows affected from that query
     *   Before the query is run a transaction is started 
     *   if the effected number of rows does not match the what is thought, a security logs is created and the the transaction is rolled back
     *   If the effected number of rows does match what is thought, the query is commited
     */
     
    function select_sqliTransaction($dir,$select_query,$expectedResult) {
        $connection = selectConnectionString($dir);
        mysqli_autocommit($connection,FALSE);
        mysqli_query($connection,"start transaction");
        $queryresult = mysqli_query($connection, $select_query); 
        $numRows = mysqli_affected_rows($connection);
        if (! $queryresult){
            echo('Database error: ' . mysqli_error($connection));
            exit;
        }   
        if($numRows != $expectedResult){
            include("logs/logsMail.php");
            mysqli_query($connection,"rollback");
        }else{
            mysqli_query($connection,"commit");
        }
        mysqli_close($connection);
        return $queryresult;
    }
    
    /*
     *   select_prepared_userLogin() takes 1 argument 
     *   it querys a view userLogonView
     *   uses prepaired statments
     *   it returns username, password, salt and numrows ina array
     */   
    
    function select_prepared_userLogin($valueToFind) {
        // ref : https://www.w3schools.com/php/php_mysql_prepared_statements.asp
        $connection = selectConnectionString(null);
        /* check connection */
        if (mysqli_connect_errno($connection)) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
        $usernameToFind = $valueToFind;
        /*
         * We have created a view of the users table called userLogonView. It only has access to username and password colums,
         * if details of the query were exploited only u-name and p-word would be exposed and no other personal information.
         */  
        /* create a prepared statement */
        if ($stmt = mysqli_prepare($connection, "SELECT username, password, salt FROM userLogonView WHERE username = ? LIMIT 1")) {
            /* bind parameters for markers */
            mysqli_stmt_bind_param($stmt, "s", $usernameToFind);
            /* execute query */
            mysqli_stmt_execute($stmt);
            /* bind result variables */
            mysqli_stmt_bind_result($stmt, $resultUsername, $resultPassword, $resultSalt);
            /* fetch value */
            $array = [];
            while (mysqli_stmt_fetch($stmt)) {
                $array = ["username" => $resultUsername, "password" => $resultPassword, "salt" => $resultSalt, "numRows" => ""];
            }
            //var_dump($array);
            $numrows = $stmt->num_rows;
            $array["numRows"] = $numrows;
            return $array;
            /* close statement */
            mysqli_stmt_close($stmt);
        }
        
        /* close connection */
        mysqli_close($connection);
    
    }
    
    /*
     *   select_prepared_userLogin_transaction() takes 1 argument
     *   starts a transaction
     *   it querys a view userLogonView
     *   uses prepaired statments
     *   it returns username, password, salt and numrows ina array
     *   If the effected number of rows does match what is thought, the query is commited, if not rolled back
     */    
    
    function select_prepared_userLogin_transaction($valueToFind) {
        $connection = selectConnectionString(null);
        /* check connection */
        if (mysqli_connect_errno($connection)) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
        // alows transactions
        mysqli_autocommit($connection,FALSE);
        // starts transaction
        mysqli_query($connection,"start transaction");
        $usernameToFind = $valueToFind;
        
        /*
         * We have created a view of the users table called userLogonView. It only has access to username and password colums,
         * if details of the query were exploited only u-name and p-word would be exposed and no other personal information.
         */
         
        if ($stmt = mysqli_prepare($connection, "SELECT username, password, salt FROM userLogonView WHERE username = ? LIMIT 1")) {
            mysqli_stmt_bind_param($stmt, "s", $usernameToFind);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $resultUsername, $resultPassword, $resultSalt);
            $array = [];
            while (mysqli_stmt_fetch($stmt)) {
                $array = ["username" => $resultUsername, "password" => $resultPassword, "salt" => $resultSalt, "numRows" => ""];
            }
            $numrows = $stmt->num_rows;
            $array["numRows"] = $numrows;
            if($numrows > 1){
                mysqli_query($connection,"rollback");
            }else{
                mysqli_query($connection,"commit");
            }
            return $array;
            mysqli_stmt_close($stmt);
        }
        mysqli_close($connection);
    
    }
    
    /*  ---------- INSERT Functions ---------- //
     *  insert_sqli(), insert_sqliLog() and insert_sqliTransaction() all use insertConnectionString() which has SELECT,INSERT and LOCK only access to the DB
     *  each one takes in a SQL query as a argument and handles faild connections to the db server and the database its self
     */    
     
    function insert_sqli($dir,$insert_query) {
        $connection = insertConnectionString($dir);
        $queryresult = mysqli_query($connection, $insert_query) 
        or die(mysqli_error($connection));
        mysqli_close($connection);
        return $queryresult;
    }
    
    /* 
     *   insert_sqliLog() takes 3 arguments the query, the table and the expected amount of rows affected from that query
     *   if the effected number of rows does not match the what is thought, a security logs is created 
     *   The effected number of rows is calculated by compairing effected rows, and counting the rows before and after the insertion 
     */    
    
    function insert_sqliLog($dir,$insert_query, $table, $expectedResult) {
        $connection = insertConnectionString($dir);
        
        $sql = "Select * FROM $table";
        $result = mysqli_query($connection,$sql); 
        $rowsBefore = mysqli_num_rows($result);
        
        $queryresult = mysqli_query($connection, $insert_query) 
        or die(mysqli_error($connection));
        $affectedRows = mysqli_affected_rows($connection);
        
        $sql = "Select * FROM $table";
        $result = mysqli_query($connection,$sql); 
        $rowsAfter = mysqli_num_rows($result);
         
        if($rowsBefore != ($rowsAfter-$expectedResult) || $affectedRows != $expectedResult){
            include("logs/logsMail.php");
        }
        mysqli_close($connection);
        return $queryresult;
    }
    
    /*
     *   insert_sqliTransaction() takes 3 arguments the query, the table and the expected amount of rows affected from that query
     *   Before the query is run a transaction is started 
     *   if the effected number of rows does not match the what is thought, a security logs is created and the the transaction is rolled back
     *   The effected number of rows is calculated by compairing effected rows, and counting the rows before and after the insertion 
     *   If the effected number of rows does match what is thought, the query is commited
     */    
    
    function insert_sqliTransaction($dir, $insert_query, $table, $expectedResult) {
        $connection = insertConnectionString($dir);
        mysqli_autocommit($connection,FALSE);
        mysqli_query($connection,"start transaction"); 
        
        $sql = "Select * FROM $table";
        $result = mysqli_query($connection,$sql); 
        $rowsBefore = mysqli_num_rows($result);
        
        $queryresult = mysqli_query($connection, $insert_query) 
        or die(mysqli_error($connection));
        $affectedRows = mysqli_affected_rows($connection);
        
        $sql = "Select * FROM $table";
        $result = mysqli_query($connection,$sql); 
        $rowsAfter = mysqli_num_rows($result);
         
        if($rowsBefore != ($rowsAfter-$expectedResult) || $affectedRows != $expectedResult){
            include("logs/logsMail.php");
            mysqli_query($connection,"rollback");
        }else{
            mysqli_query($connection,"commit");
        }
        mysqli_close($connection);
        return $queryresult;
    }
    
    /*
     *   insert_prepared_imageUpload takes 6 arguments and querys a prepaired statment to call images
     *   exacutes the query and the takes the affeted rows
     *   checks the affected rows agains the expected rows
     *   returns true if affected rows are equal expected rows they match, and false if not
     */     
    
    function insert_prepared_imageUpload($dir, $ufilename, $uhash, $uowner, $uvirusFree, $expectedResult) {
        $connection = insertConnectionString($dir);
        // Check connection
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }
        $stmt = $connection->prepare("INSERT INTO images (filename, hash, owner, virusFree) VALUES (?,?,?,?)");
        $filename = $ufilename;
        $hash = $uhash;
        $owner = $uowner;
        $virusFree = $uvirusFree;
        $stmt->bind_param("ssss", $filename, $hash, $owner, $virusFree);
        $stmt->execute();
        $affectedRows = mysqli_stmt_affected_rows($stmt);
        // check expected result
        if($affectedRows != $expectedResult){
            //include("logs/logsMail.php");
            return false;
        }else{
            return true;
        }
    }   
    
    /*
     *   insert_prepared_imageUploadTransaction takes 6 arguments and querys a prepaired statment to call images
     *   starts a transaction, exacutes the query and the takes the affeted rows
     *   checks the affected rows agains the expected rows
     *   returns true and commits the transaction if affected rows are equal, expected rows they match, and false and rolls back if not
     */ 
        
    function insert_prepared_imageUploadTransaction($dir, $ufilename, $uhash, $uowner, $uvirusFree, $expectedResult) {
        $connection = insertConnectionString($dir);
        mysqli_autocommit($connection,FALSE);
        mysqli_query($connection,"start transaction"); 
        
        // Check connection
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }
        $stmt = $connection->prepare("INSERT INTO images (filename, hash, owner, virusFree) VALUES (?,?,?,?)");
        $filename = $ufilename;
        $hash = $uhash;
        $owner = $uowner;
        $virusFree = $uvirusFree;
        $stmt->bind_param("ssss", $filename, $hash, $owner, $virusFree);
        $stmt->execute();
        $affectedRows = mysqli_stmt_affected_rows($stmt);
        // check expected result
        if($affectedRows != $expectedResult){
            //include("logs/logsMail.php");
            mysqli_query($connection,"rollback");
            return false;
        }else{
            mysqli_query($connection,"commit");
            return true;
        }
        mysqli_close($connection);
    }
    
    /*  ---------- UPDATE Functions ---------- //
     *  update_sqli(), update_sqliLog() and update_sqliTransaction() all use updateConnectionString() which has SELECT,UPDATE and LOCK only access to the DB
     *  each one takes in a SQL query as a argument and handles faild connections to the db server and the database its self
     */     
    
    function update_sqli($dir,$update_query){
        $connection = updateConnectionString($dir);
        $queryresult = mysqli_query($connection, $update_query)
        or die(mysqli_error($connection));
        mysqli_close($connection);
        return $queryresult;
    }
    
    /* 
     *   update_sqliLog() takes 3 arguments the query, the table and the expected amount of rows affected from that query
     *   if the effected number of rows does not match the what is thought, a security logs is created 
     *   The effected number of rows is calculated by compairing effected rows, and counting the rows before and after the update 
     */     
    
    function update_sqliLog($dir,$update_query, $table, $expectedResult){
        $connection = updateConnectionString($dir);
        
        $sql = "Select * FROM $table";
        $result = mysqli_query($connection,$sql); 
        $rowsBefore = mysqli_num_rows($result);
        
        $queryresult = mysqli_query($connection, $update_query) 
        or die(mysqli_error($connection));
        $affectedRows = mysqli_affected_rows($connection);
        
        $sql = "Select * FROM $table";
        $result = mysqli_query($connection,$sql); 
        $rowsAfter = mysqli_num_rows($result);
        
        if(($rowsBefore != $rowsAfter) || ($affectedRows != $expectedResult)){
            if($affectedRows != 0){
                include("logs/logsMail.php");
            }   
        }
        mysqli_close($connection);
        return $queryresult;
    }
    
    /*
     *   update_sqliTransaction() takes 3 arguments the query, the table and the expected amount of rows affected from that query
     *   Before the query is run a transaction is started 
     *   if the effected number of rows does not match the what is thought, a security logs is created and the the transaction is rolled back
     *   The effected number of rows is calculated by compairing effected rows, and counting the rows before and after the update 
     *   If the effected number of rows does match what is thought, the query is commited
     */       
    
    function update_sqliTransaction($dir,$update_query, $table, $expectedResult){
        $connection = updateConnectionString($dir);
        mysqli_autocommit($connection,FALSE);
        mysqli_query($connection,"start transaction");         
        
        $sql = "Select * FROM $table";
        $result = mysqli_query($connection,$sql); 
        $rowsBefore = mysqli_num_rows($result);
        
        $queryresult = mysqli_query($connection, $update_query) 
        or die(mysqli_error($connection));
        $affectedRows = mysqli_affected_rows($connection);
        
        $sql = "Select * FROM $table";
        $result = mysqli_query($connection,$sql); 
        $rowsAfter = mysqli_num_rows($result);
        
        if(($rowsBefore != $rowsAfter) || ($affectedRows != $expectedResult)){
            if($affectedRows != 0){
                include("logs/logsMail.php");
                mysqli_query($connection,"rollback");
            }else{
                mysqli_query($connection,"commit");
            }    
        }else{
            mysqli_query($connection,"commit");
        }
        mysqli_close($connection);
        return $queryresult;
    }  
    
    /*  ---------- DELETE Functions ---------- //
     *  delete_sqli(), delete_sqliLog() and delete_sqliTransaction() all use deleteConnectionString() which has SELECT, DELETE and LOCK only access to the DB
     *  each one takes in a SQL query as a argument and handles faild connections to the db server and the database its self
     */     
    
    function delete_sqli($dir,$delete_query){
        $connection = deleteConnectionString($dir);
        $queryresult = mysqli_query($connection, $delete_query)
        or die(mysqli_error($connection));
        mysqli_close($connection);
        return $queryresult;
    }
    
    /* 
     *   delete_sqliLog() takes 3 arguments the query, the table and the expected amount of rows affected from that query
     *   if the effected number of rows does not match the what is thought, a security logs is created 
     *   The effected number of rows is calculated by compairing effected rows, and counting the rows before and after the delete 
     */      
    
    function delete_sqliLog($dir,$delete_query, $table, $expectedResult){
        $connection = deleteConnectionString();
        
        $sql = "Select * FROM $table";
        $result = mysqli_query($connection,$sql); 
        $rowsBefore = mysqli_num_rows($result);
        
        $queryresult = mysqli_query($connection, $delete_query) 
        or die(mysqli_error($connection));
        $affectedRows = mysqli_affected_rows($connection);
        
        $sql = "Select * FROM $table";
        $result = mysqli_query($connection,$sql); 
        $rowsAfter = mysqli_num_rows($result);
        
        if(($rowsBefore != ($rowsAfter + $expectedResult)) || ($affectedRows != $expectedResult)){
            if($affectedRows != 0){
                include("logs/logsMail.php");
            }    
        }
        mysqli_close($connection);
        return $queryresult;
    }
    
    /*
     *   delete_sqliTransaction() takes 3 arguments the query, the table and the expected amount of rows affected from that query
     *   Before the query is run a transaction is started 
     *   if the effected number of rows does not match the what is thought, a security logs is created and the the transaction is rolled back
     *   The effected number of rows is calculated by compairing effected rows, and counting the rows before and after the delete 
     *   If the effected number of rows does match what is thought, the query is commited
     */      
    
    function delete_sqliTransaction($dir,$delete_query, $table, $expectedResult){
        $connection = deleteConnectionString($dir);
        mysqli_autocommit($connection,FALSE);
        mysqli_query($connection,"start transaction");         
        
        $sql = "Select * FROM $table";
        $result = mysqli_query($connection,$sql); 
        $rowsBefore = mysqli_num_rows($result);
        
        $queryresult = mysqli_query($connection, $delete_query) 
        or die(mysqli_error($connection));
        $affectedRows = mysqli_affected_rows($connection);
        
        $sql = "Select * FROM $table";
        $result = mysqli_query($connection,$sql); 
        $rowsAfter = mysqli_num_rows($result);
        
        if(($rowsBefore != ($rowsAfter + $expectedResult)) || ($affectedRows != $expectedResult)){
            if($affectedRows != 0){
                include("logs/logsMail.php");
                mysqli_query($connection,"rollback");
            }else{
                mysqli_query($connection,"commit");
            }    
        }else{
            mysqli_query($connection,"commit");
        }
        mysqli_close($connection);
        return $queryresult;
    }
    
?>