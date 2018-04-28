<?php

    function select_prepared_inRequestView($dir,$uid, $company) {

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

        if ($stmt = mysqli_prepare($connection, "SELECT uid, name, description, infoForm FROM portfolios WHERE owner = ? AND uid = ?")) {
            mysqli_stmt_bind_param($stmt, "ss", $company, $uid);
            mysqli_stmt_execute($stmt);
            $uid = "";
            $resultRequestName = "";
            $resultDiscription = "";
            $infoForm = "";
            mysqli_stmt_bind_result($stmt, $uid, $resultRequestName, $resultDiscription, $infoForm);   
            while (mysqli_stmt_fetch($stmt)) {
                ?>
                    <li class='list-group-item'>
                        <form action="../../controler/inRequestSubmit.php" method="post">
                            <input type="hidden" name="uid" value="<?php echo $uid; ?>">
                            <b><?php echo $resultRequestName;?> </b>
                            <br><?php echo $resultDiscription; ?><br><br>
                            <textarea name="infoForm" rows='4'cols='100'><?php echo $infoForm; ?></textarea>
                            <br>
                            <button class='btn btn-outline-info btn-xs float-right' type="submit" value="Submit">Request</button>
                        </form>
                    </li>
                <?php
            }
            mysqli_stmt_close($stmt);
        }
       mysqli_close($connection);
    }
 
?>