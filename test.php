<?php
session_start();

    //include('model/insertModel.php');
    include('model/selectModel.php');
    //$age = array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43");
    
    //echo $age['Peter'];
    
    //$YourSerializedData = base64_encode(serialize($age));
    

    //print_r($_SESSION);
    //select_sqli(null,"SELECT array WHERE uid = 1");
    
    $result = select_sqli(null,"SELECT array FROM test WHERE uid = 1");
    while ($row = mysqli_fetch_assoc($result)) {
        $YourSerializedData = $row['array'];
    }
    
    $newArray = unserialize(base64_decode($YourSerializedData));
    
    echo '<pre>';
    print_r($newArray);
    
    

?>