<?php
echo "<pre>";


$str = "23;24;25;27;9;22;8";
    
$teamstring = $str;
echo $teamstring."<br>";
$teamarray = explode(";",$teamstring);
print_r($teamarray)
?>