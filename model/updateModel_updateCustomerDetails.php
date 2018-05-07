<?php

    function update_prepared_updateCustomerDetails($dir, $uid, $username, $email, $company, $expectedResult) {
        // connection details are stored outside the web directory and are defined
        include($dir."../pem/sqlUpdate.php");
        $connection = mysqli_connect(uHOST, uUSER, uPASS);
        if (!$connection) {
            trigger_error("Could not reach database!<br/>");
            error_log("Could not connect! update_prepared_SetCompanyToUser(),", 0);
            exit();
        }
        $db_selected = mysqli_select_db($connection, uDB);
        if (!$db_selected) {
            trigger_error("Could not reach database!<br/>");
            error_log("Could not connect! update_prepared_SetCompanyToUser(),", 0);
            exit();
        }
        // Check connection
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }
        // "UPDATE users SET company = ?  WHERE username = ?
        $stmt = $connection->prepare("UPDATE customers SET username = ?, email = ? WHERE uid = ? AND company = ?");
        $stmt->bind_param("ssss", $username, $email, $uid, $company);
        if(!$stmt->execute()){
            error_log("Could not reach database! update_prepared_updateTeam(),", 0);
        }
        $affectedRows = mysqli_stmt_affected_rows($stmt);
        // check expected result
        if($affectedRows != $expectedResult){
            error_log("Unexpected DB result! update_prepared_updateTeam(),", 0);
            return false;
        }else{
            return true;
        }
    }
    
    update_prepared_updateCustomerDetails("../", 7, "test", "test@test", "Don.inc", 1) ;

?>