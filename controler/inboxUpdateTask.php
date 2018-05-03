<?php

    include('../model/selectModel.php');
    include("../model/selectModel_inboxUpdateTask.php");
    include("../model/updateModel_inboxUpdateTask.php");

    if(isset($_GET['Rid'])){
        $UNTRUSTED_rid = $_GET['Rid'];
        $subjectRID = stripslashes(trim($UNTRUSTED_rid));
        $rid = escape_data("../",$subjectRID);
    }
    
    if(isset($_GET['Qid'])){
        $UNTRUSTED_qid = $_GET['Qid'];
        $subjectQID = stripslashes(trim($UNTRUSTED_qid));
        $qid = escape_data("../",$subjectQID);
    }

    // model: selectModel_inboxUpdateTask.php
    // array('taskHops' => $taskHops, 'requestObj' => $requestObj, 'currentTask' => $currentTask);
    $requestObj = select_prepared_inboxSelectRequestByRid("../",$rid);
    
    $requestObjArray = unserialize(base64_decode($requestObj['requestObj']));
    echo "hops: ".$requestObj['taskHops']."  total".$requestObjArray['totalTasks'];
    if($requestObj['taskHops'] == $requestObjArray['totalTasks']){
         // updateModel_inboxUpdateTask.php $dir, $uid,
         echo "fin";
         
        if(update_prepared_inboxUpdateCompleate("../",$rid,1)){
            echo "finished request";
        }else{
            error_log("Could not connect! update_prepared_inboxUpdateCompleate(),", 0);
        }
    }else{
        $countOfTaskHops = $requestObj['taskHops']; 
        $countOfTaskHops++;
        $currentTask = $requestObjArray['tasks']['team'.$countOfTaskHops];
        $currentActivity = $requestObjArray['tasks']['action'.$countOfTaskHops];
        $taskHops = $countOfTaskHops;
        
        // updateModel_inboxUpdateTask.php $dir, $uid, $currentTask, $currentActivity, $taskHops, $expectedResult
        if(update_prepared_inboxUpdateCurrentTask("../",$rid,$requestObjArray['tasks']['team'.$countOfTaskHops],$requestObjArray['tasks']['action'.$countOfTaskHops],$countOfTaskHops,1)){
            echo "sucess";
        }else{
            error_log("Could not connect! update_prepared_inboxUpdateCurrentTask(),", 0);
        }
        
    }
    
    header('location: ../view/vendor/inboxView.php?Qid='.$qid)

?>