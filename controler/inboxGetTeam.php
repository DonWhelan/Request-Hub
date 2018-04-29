<?php
                        
    $UNTRUSTED_uid = $_GET['Qid'];
    $subjectUID = stripslashes(trim($UNTRUSTED_uid));
    $uid = escape_data("../../",$subjectUID);
    if (!in_array($uid, $_SESSION['accessQueues']['array'])) {
        echo "This attempt to access service queue ".$uid." has been logged.";
        error_log($_SESSION['user']."-".$_SESSION['ip']."-access denied on Qid: ".$uid, 0);
        exit;
    }
    
    $teamName = select_prepared_inboxGetTeamNameByUID("../../",$uid);
                        
?>