
<?php

    function select_prepared_profileShowRequests($dir,$company, $user) {

        include($dir."../pem/sqlSelect.php");
        $connection = mysqli_connect(sHOST, sUSER, sPASS);
        if (!$connection) {
            trigger_error("Could not reach database!<br/>");
            error_log("Could not connect! select_prepared_teamEdit(),", 0);
            exit();
        }
        $db_selected = mysqli_select_db($connection, sDB);
        if (!$db_selected) {
            trigger_error("Could not reach database!<br/>");
            error_log("Could not connect! select_prepared_teamEdit(),", 0);
            exit();
        }
        /* check connection */
        if (mysqli_connect_errno($connection)) {
            error_log("Could not connect! select_prepared_teamEdit(),", 0);
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
        
        /*
         * We have created a view of the users table called userLogonView. It only has access to username and password colums,
         * if details of the query were exploited only u-name and p-word would be exposed and no other personal information.
         */

        if ($stmt = mysqli_prepare($connection, "SELECT uid, name, timestamp, compleate FROM requests WHERE submitter = ? AND owner = ? ORDER BY compleate")) {
            mysqli_stmt_bind_param($stmt, "ss", $user, $company);
            mysqli_stmt_execute($stmt);
            $uid = "";
            $resultName = "";
            $resultTime = "";
            $resultCompleate = "";
            mysqli_stmt_bind_result($stmt, $uid, $resultName, $resultTime, $resultCompleate);
            while (mysqli_stmt_fetch($stmt)) {
                if($resultCompleate == 0){
                    $resultCompleate = "Ongoing";
                    echo "<tr>
                      <th scope='row'>".$uid."</th>
                      <th>".$resultName."</th>
                      <th>".$resultTime."</th>
                      <th>".$resultCompleate."</th>
                      <td><a href='profileView.php?uid=".$uid."'><button class='btn btn-outline-success btn-xs float-right' type='submit'>view</button></a></td>
                    </tr>";
                }else{
                    $resultCompleate = "Compleate";
                    echo "<tr>
                      <td scope='row'>".$uid."</td>
                      <td>".$resultName."</td>
                      <td>".$resultTime."</td>
                      <td>".$resultCompleate."</td>
                      <td><a href='profileView.php?uid=".$uid."'><button class='btn btn-outline-success btn-xs float-right' type='submit'>view</button></a></td>
                    </tr>";
                }
               
            }
            mysqli_stmt_close($stmt);
        }
       mysqli_close($connection);
    }
    
    
?>