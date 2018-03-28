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
    function masterConnectionString(){
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
        include("../../pem/sqlMaster.php");
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
    function selectConnectionString(){
        // connection details are stored outside the web directory and are defined
        include("../pem/sqlSelect.php");
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
    function insertConnectionString(){
        // connection details are stored outside the web directory and are defined
        include("../pem/sqlInsert.php");
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
    function updateConnectionString(){
        // connection details are stored outside the web directory and are defined
        include("../pem/sqlUpdate.php");
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
    function deleteConnectionString(){
        // connection details are stored outside the web directory and are defined
        include("../pem/sqlDelete.php");
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
     
    function escape_data($dataFromForms) {
        $conn = selectConnectionString();
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
    
    /*  - select_sqli Functions - 
     *  select_sqli(), select_sqliLog() and select_sqliTransaction() all use selectConnectionString() which has SELECT and LOCK only access to the DB
     *  each one takes in a SQL query as a argument and handles faild connections to the db server and the database its self
     */    
    
    //  select_sqli() passes a Select query to the DB with no checks on how that query effects the DB 
    function select_sqli($select_query) {
        $connection = selectConnectionString();
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
     
    function select_sqliLog($select_query,$expectedResult) {
        $connection = selectConnectionString();
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
     
    function select_sqliLog_max1_Rnum($select_query,$expectedResult) {
        $connection = selectConnectionString();
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
     
    function select_sqliTransaction($select_query,$expectedResult) {
        $connection = selectConnectionString();
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
    
    
    function select_prepared_userLogin($valueToFind) {
        // ref : https://www.w3schools.com/php/php_mysql_prepared_statements.asp
        $connection = selectConnectionString();
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
            // /* fetch value */
            $array = [];
            //$result = mysqli_stmt_fetch($stmt);
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
    
    function select_prepared_userLogin_transaction($valueToFind) {
        $connection = selectConnectionString();
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
    
    /*  - insert_sqli Functions - 
     *  insert_sqli(), insert_sqliLog() and insert_sqliTransaction() all use insertConnectionString() which has SELECT,INSERT and LOCK only access to the DB
     *  each one takes in a SQL query as a argument and handles faild connections to the db server and the database its self
     */    
     
    //  select_sqli() passes a insert query to the DB with no checks on how that query effects the DB     
    function insert_sqli($insert_query) {
        $connection = insertConnectionString();
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
    
    function insert_sqliLog($insert_query, $table, $expectedResult) {
        $connection = insertConnectionString();
        
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
    
    function insert_sqliTransaction($insert_query, $table, $expectedResult) {
        $connection = insertConnectionString();
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
    
    /*  - update_sqli Functions - 
     *  update_sqli(), update_sqliLog() and update_sqliTransaction() all use updateConnectionString() which has SELECT,UPDATE and LOCK only access to the DB
     *  each one takes in a SQL query as a argument and handles faild connections to the db server and the database its self
     */     
    
    //  update_sqli() passes a update query to the DB with no checks on how that query effects the DB      
    function update_sqli($update_query){
        $connection = updateConnectionString();
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
    
    function update_sqliLog($update_query, $table, $expectedResult){
        $connection = updateConnectionString();
        
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
    
    function update_sqliTransaction($update_query, $table, $expectedResult){
        $connection = updateConnectionString();
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
    
    /*  - delete_sqli Functions - 
     *  delete_sqli(), delete_sqliLog() and delete_sqliTransaction() all use deleteConnectionString() which has SELECT, DELETE and LOCK only access to the DB
     *  each one takes in a SQL query as a argument and handles faild connections to the db server and the database its self
     */     
    
    //  delete_sqli() passes a delete query to the DB with no checks on how that query effects the DB      
    function delete_sqli($delete_query){
        $connection = deleteConnectionString();
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
    
    function delete_sqliLog($delete_query, $table, $expectedResult){
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
    
    function delete_sqliTransaction($delete_query, $table, $expectedResult){
        $connection = deleteConnectionString();
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
    
    
    
    // PREPAIRED QUERY  
    
    function select_prepared($valueToFind) {
        $connection = selectConnectionString();
        /* check connection */
        if (mysqli_connect_errno($connection)) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
        
        /* create a prepared statement */
        if ($stmt = mysqli_prepare($connection, "SELECT username FROM users where username = ? ")) {
      
            /* bind parameters for markers */
            mysqli_stmt_bind_param($stmt, $valueToFind);
        
            /* execute query */
            mysqli_stmt_execute($stmt);
            /* bind result variables */
            mysqli_stmt_bind_result($stmt,  $value);
        
            /* fetch value */
            while(mysqli_stmt_fetch($stmt)){
                echo $value;
            }
        
            /* close statement */
            mysqli_stmt_close($stmt);
            //return $value;
        }
        
        /* close connection */
        mysqli_close($connection);
    }
    
    //select_prepared(102);

    
   
?>