<?php
    if(isset($_GET['Qid'])){                   
        $UNTRUSTED_qid = $_GET['Qid'];
        $subjectQID = stripslashes(trim($UNTRUSTED_qid));
        $qid = escape_data("../../",$subjectQID);
        if (!in_array($qid, $_SESSION['accessQueues']['array'])) {
            echo "This attempt to access service queue ".$qid." has been logged.";
            error_log($_SESSION['user']."-".$_SESSION['ip']."-access denied on Qid: ".$qid, 0);
            exit;
        }
        $teamName = select_prepared_inboxGetTeamNameByUID("../../",$qid);
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