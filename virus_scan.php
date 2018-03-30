<?php

    /*
     *  called as cronjon (1) removes files that failed VT every 12 mins
     */

    $connection = mysqli_connect("localhost", "root", "9;M2*C?8t{m}yA^PTJ#G");
    if (!$connection) {
        trigger_error("Could not reach database!<br/>");
        exit();
    }
    $db_selected = mysqli_select_db($connection, "RequestHub");
    if (!$db_selected) {
        trigger_error("Could not reach database!<br/>");
        exit();
    } 

    mysqli_query($connection, "DELETE FROM images WHERE virusFree = 0 AND timeUploaded < now() - interval 12 minute")
    or die(mysqli_error($connection));
    mysqli_close($connection);
    
?>