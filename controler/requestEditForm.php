<?php
    function getUID(){
        if(isset($_GET['uid'])){                   
            $UNTRUSTED_qid = $_GET['uid'];
            $subjectQID = stripslashes(trim($UNTRUSTED_qid));
            $uid = escape_data("../../",$subjectQID);
            return $uid;
            //  Model: selectModel_requestEditForm.php
            // "SELECT name, description, infoForm, currentTask, requestObj FROM portfolios WHERE uid = ?"
            //$requestArray = select_prepared_requestEditView("../../",$uid);
    
        }
    }
    
?>