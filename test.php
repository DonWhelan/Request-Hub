<?php
session_start();


$request = array("totalTasks" => 3, "tasks" => array());
              
              
                                  "team1" => "team1",
                                  "action1" => "action1",
                                  "team2" => "team2",
                                  "action2" => "action2",
                                  "team3" => "team3",
                                  "action3" => "action3"
    echo "<pre>";        
    print_r($request);
    echo "<br><br><br>";
    echo $request['totalTasks']."<br>";
    echo $request['tasks']['team3'] ;
    echo "<br><br><br>";
    
    $test = array(); //init
    $test['solution'] = 'good';
    print_r($test);
    
    
    
    

?>