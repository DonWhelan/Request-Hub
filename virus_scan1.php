<?php

    /*
     *  called as cronjon (2) runs on every 10 minutes checks for 
     */

    function VirusTotalCheckHashOfSubmitedFile($hash){
        $debug = false;
        $post = array('apikey' => '62ce324bb90c77befcd8c11b46869b2c8274e81544de94d9896e3ea6497c1826','resource'=>$hash);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.virustotal.com/vtapi/v2/file/report');
        curl_setopt($ch, CURLOPT_POST,1);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate'); // please compress data
        curl_setopt($ch, CURLOPT_USERAGENT, "gzip, My php curl client");
        curl_setopt($ch, CURLOPT_VERBOSE, 1); // remove this if your not debugging
        curl_setopt($ch, CURLOPT_RETURNTRANSFER ,true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
         
        $result = curl_exec ($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($status_code == 200) { // OK
          $js = json_decode($result, true);
           if($debug){echo "<pre>";}
           if($debug){print_r($js);}
          if($js["positives"]==0){
              // clean
            return true;
          }else{
              // malware
            return false;
          }
        } else {  // Error occured
          print($result);
        }
        curl_close ($ch);
    }
  

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
    // Selecs images that have not been marked as clean by virus total
    $result = mysqli_query($connection, "Select hash FROM images WHERE virusFree = 0"); 
    if (! $result){
        echo('Database error: ' . mysqli_error($connection));
        exit;
    }
    while ($row = mysqli_fetch_assoc($result)) {
        // checks for results on scanned images
        if(VirusTotalCheckHashOfSubmitedFile($row['hash'])){
            // if report returns image is malware free we update its virusFree attribute to true
            $hash = $row['hash'];
            $result2 = mysqli_query($connection, "UPDATE images SET virusFree = 1 WHERE hash = '$hash'"); 
            if (! $result2){
                echo('Database error: ' . mysqli_error($connection));
                exit;
            }
        }else{
            // if not it deletes the image
            $hash = $row['hash'];
            $result2 = mysqli_query($connection, "DELETE FROM images WHERE hash = '$hash' ");
            if (! $result2){
                echo('Database error: ' . mysqli_error($connection));
                exit;
            }
        }
    }  
?>