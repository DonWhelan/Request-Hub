<?php

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
?>