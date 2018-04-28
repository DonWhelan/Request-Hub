<?php 
    function showRequest($UCid){
        
        $UCid = stripslashes(trim($UCid));
        if (preg_match ('%^[A-Za-z0-9\.\' \-!_]{1,20}$%',$UCid)) {
            $id = escape_data('../../',$UCid);
        } else {
            error_log("failed regex:".$_SESSION['user']."-".get_client_ip_env(), 0);
            //If criteria is not met $passedRegex is set to false so the query connection will not open
            $passedRegex = FALSE;
            //we redirect the user back to newUser.php but add info to thr URL yo we can read why the user has been sent back and display the correct error messege
            header("Location: ../view/userRegister.php?message=char");
            exit();
        }
        
        $company = $_SESSION['company'];
        select_prepared_inRequestView("../../", $id, $company);
    
    }
?>