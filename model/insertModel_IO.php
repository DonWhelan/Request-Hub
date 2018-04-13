<?php


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
            error_log("unable to connect! insert_prepared_imageUpload(),", 0);
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
            error_log("inexpected result! insert_prepared_imageUpload(),", 0);
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
            error_log("unable to connect! insert_prepared_imageUploadTransaction(),", 0);
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
            error_log("unexpected results! insert_prepared_imageUploadTransaction(),", 0);
            mysqli_query($connection,"rollback");
            return false;
        }else{
            mysqli_query($connection,"commit");
            return true;
        }
        mysqli_close($connection);
    }
    
?>