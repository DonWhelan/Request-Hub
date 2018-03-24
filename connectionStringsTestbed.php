<?php
    include("connectionStrings.php");
    //ini_set('display_errors', 'On');
    // connectionStringsTestbed
/* ---------------------  SELECT  ---------------------------------*/
    // ------- select_sqli()
    // $result = select_sqli("SELECT * FROM userLogonView");
    // while ($row = mysqli_fetch_assoc($result)) {
    //     echo $row['username'] . "<br>";
    // }
    //
    // ------- select_sqliLog()
    // $result = select_sqliLog("SELECT * FROM testtable where value=101", 2);
    // while ($row = mysqli_fetch_assoc($result)) {
    //     echo $row['key'] . "<br>";
    // }
    //
    // ------- select_sqliLogMax()
    // $result = select_sqliLogMax("SELECT * FROM testtable where value=1002", 2);
    // while ($row = mysqli_fetch_assoc($result)) {
    //     echo $row['key'] . "<br>";
    // }
    //
    // ------- select_sqliTransaction()
    // $result = select_sqliTransaction("SELECT * FROM testtable where value=101", 2);
    // while ($row = mysqli_fetch_assoc($result)) {
    //     echo $row['key'] . "<br>";
    // }
    
    /* ---------------------  INSERT  ---------------------------------*/
    // ------ insert_sqli()
    // insert_sqli("INSERT INTO `users`(`username`, `password`, `email`) VALUES ('pep1','pep1','pep@pep1.com')");
    //
    // ------ insert_sqliLog()
    // insert_sqliLog("INSERT INTO testtable (value) VALUES ('1002')","testtable",2);
    //
    // ------ insert_sqliTransaction()
    // insert_sqliTransaction("INSERT INTO testtable (value) VALUES ('1003')","testtable",2);
    
    /* ---------------------  UPDATE  ---------------------------------*/
    // ------ update_sqli()    
    // update_sqli("UPDATE users SET username='sha2' WHERE username='sha'");
    //
    // ------ update_sqliLog()  
    // update_sqliLog("UPDATE testtable SET value=105 WHERE value=106","testtable",1);
    //
    // ------ update_sqliTransaction() 
    // update_sqliTransaction("UPDATE testtable SET value=105 WHERE value=106","testtable",1);
    
    /* ---------------------  Delete  ---------------------------------*/   
    // ------ delete_sqli()  
    // delete_sqli("DELETE FROM users WHERE username ='pep'");
    //
    // ------ delete_sqliLog()  
    // delete_sqliLog("DELETE FROM testtable WHERE value=104","testtable",1);
    //
    // ------ delete_sqliTransaction()  
    // delete_sqliTransactio("DELETE FROM testtable WHERE value=104","testtable",1);
        
?>