<?php


    // deleteConnectionString() only has SELECT and DELETE permission on its account on the MYSQL Server.      
    function deleteConnectionString($dir){
        // connection details are stored outside the web directory and are defined
        include($dir."../pem/sqlDelete.php");
        $connection = mysqli_connect(dHOST, dUSER, dPASS);
        if (!$connection) {
            trigger_error("Could not reach database!<br/>");
            error_log("Could not connect! deleteConnectionString(),", 0);
            exit();
        }
        $db_selected = mysqli_select_db($connection, dDB);
        if (!$db_selected) {
            trigger_error("Could not reach database!<br/>");
            error_log("Could not connect! deleteConnectionString(),", 0);
            exit();
        } 
        return $connection;
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
                error_log("unexpected result! deleteConnectionString(),", 0);
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
                error_log("unexpected result! deleteConnectionStringTransaction(),", 0);
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