<?php
    
    /*
     * Gets Qid and Rid from the URL passes through escapeData()
     */

    if(isset($_GET['Qid'])){                   
        $UNTRUSTED_qid = $_GET['Qid'];
        $subjectQID = stripslashes(trim($UNTRUSTED_qid));
        $qid = escape_data("../../",$subjectQID);
        //access check
        if (!in_array($qid, $_SESSION['accessQueues']['array'])) { 
        ?>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            <div class="container-fluid">
        <?php 

            
            echo "This attempt to access service queue ".$qid." has been logged for review.";
            error_log($_SESSION['user']."-".$_SESSION['ip']."-access denied on Qid: ".$qid, 0);
            exit;
        }
        // Model: selectModel_inboxShowRequests.php
        // "SELECT teamName FROM Teams WHERE uid = ?"
        $teamName = select_prepared_inboxGetTeamNameByUID("../../",$qid);
        $qid;
    }
    
    
    
    if(isset($_GET['uid'])){
        $UNTRUSTED_uid = $_GET['uid'];
        $subjectUID = stripslashes(trim($UNTRUSTED_uid));
        $rid = escape_data("../../",$subjectUID);
        if (!in_array($qid, $_SESSION['accessQueues']['array'])) {
            echo "This attempt to access service queue ".$rid." has been logged.";
            error_log($_SESSION['user']."-".$_SESSION['ip']."-access denied on Qid: ".$rid, 0);
            exit;
        }
    }
                        
?>