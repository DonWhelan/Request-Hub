<?php

    /*
     *   insert_prepared_imageUpload takes 6 arguments and querys a prepaired statment to call images
     *   exacutes the query and the takes the affeted rows
     *   checks the affected rows agains the expected rows
     *   returns true if affected rows are equal expected rows they match, and false if not
     */     
    
    function insert_prepared_companyUpload($dir, $name, $address, $address2, $postcode, $country, $expectedResult) {
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
        // Check connection
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }
        
        $stmt = $connection->prepare("INSERT INTO company (name, address, address2, postcode, country) VALUES (?,?,?,?,?)");
        $stmt->bind_param("sssss", $name, $address, $address2, $postcode, $country);
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
    
    function insert_prepared_companyUploadTransaction($dir, $name, $address, $address2, $postcode, $country, $expectedResult) {
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
        // Check connection
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }
        
        // alows transactions
        mysqli_autocommit($connection,FALSE);
        // starts transaction
        mysqli_query($connection,"start transaction");
        
        
        $stmt = $connection->prepare("INSERT INTO company (name, address, address2, postcode, country) VALUES (?,?,?,?,?)");
        $stmt->bind_param("sssss", $name, $address, $address2, $postcode, $country);
        $stmt->execute();
        $affectedRows = mysqli_stmt_affected_rows($stmt);
        // check expected result
        if($affectedRows == $expectedResult){
            //include("logs/logsMail.php");
            mysqli_query($connection,"rollback");
            return false;
        }else{
            mysqli_query($connection,"commit");
            return true;
        }
    } 


?>