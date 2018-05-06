<?php
     function getUID($uidFromURI){
        if(isset($uidFromURI)){
            $UNTRUSTED_uid = $uidFromURI;
            $subjectUID = stripslashes(trim($UNTRUSTED_uid));
            $uid = escape_data("../../",$subjectUID);
            return $uid;
        }else{
            return false;
        }
     }
?>