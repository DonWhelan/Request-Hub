<?php
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
?>