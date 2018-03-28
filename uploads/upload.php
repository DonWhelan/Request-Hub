<!DOCTYPE html>
<html>
<head>
  <title>Upload your files</title>
</head>
<body>
  <form enctype="multipart/form-data" action="upload.php" method="POST">
    <p>Upload your file</p>
    <input type="file" name="uploaded_file"></input><br />
    <input type="submit" value="Upload"></input>
  </form>
</body>
</html>
<?PHP
    $debug = true;
    //ref: https://www.virustotal.com/en/documentation/public-api/
    function VirusTotalFileCheck($path){  
        global $debug;
        $file_name_with_full_path = realpath($path);
        $api_key = getenv('VT_API_KEY') ? getenv('VT_API_KEY') :'62ce324bb90c77befcd8c11b46869b2c8274e81544de94d9896e3ea6497c1826';
        $cfile = curl_file_create($file_name_with_full_path);
         
        $post = array('apikey' => $api_key,'file'=> $cfile);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.virustotal.com/vtapi/v2/file/scan');
        curl_setopt($ch, CURLOPT_POST, True);
        curl_setopt($ch, CURLOPT_VERBOSE, 1); // remove this if your not debugging
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate'); // please compress data
        curl_setopt($ch, CURLOPT_USERAGENT, "gzip, My php curl client");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER ,True);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
         
        $result=curl_exec ($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if($debug){print("status = $status_code\n");}
        if ($status_code == 200) { // OK
            $js = json_decode($result, true);
            //debug
               
            if($debug){echo "<pre>";}
            if($debug){print_r($js);}
            $rc = $js["response_code"];
            $sha256 = $js["sha256"];
            $array = [];
            $array = ["response_code" => $rc, "sha256" => $sha256];
            return $array;
            
        } else {  // Error occured
            print($result);
        }
        curl_close ($ch);
    }
  
  function VirusTotalCheckHashOfSubmitedFile($hash){
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

    require_once('../connectionStrings.php');
    include('virustotal.class.php');
    // VirusTotalFileCheck($path);
    // VirusTotalCheckHashOfSubmitedFile($hash);
    
    // 1 - only logged in user can upload file(session managment)
    
    // 2 - set file size
    ini_set('post_max_size', '40M');
    ini_set('upload_max_filesize', '40M');
    ini_set('max_file_uploads', 2);
    
    
    // 3 - check if it is a image
    // images will return a array ising getimagesize()
    if(@is_array(getimagesize($_FILES['uploaded_file']['tmp_name']))){
        // debbug
        if($debug){echo "is a image<br>";
        echo "name: ".$_FILES['uploaded_file']['name']."<br>";
        echo "size ".$_FILES['uploaded_file']['size']."<br>";
        print_r($_FILES['uploaded_file']);}

        // 3 - check file size
        if ($_FILES['uploaded_file']['size'] > 400000){
            if($debug){echo "file too large";}
            // handel error
        }else{
            // 4 - check if it is a image (by ext)
            if(!empty($_FILES['uploaded_file'])){
                $path = "images/";
                $ext = (explode(".", $_FILES['uploaded_file']['name']));
                $ext = end($ext);
                if($debug){echo $ext."<br>";}
                
                // 5 - check if it is a image (by type)
                $allowed_types = ['image/jpg', 'image/png', 'image/jpeg', 'image/gif']; 
                if (!in_array($_FILES['uploaded_file']['type'], $allowed_types)) {
                    die();
                    // handel error
                }
            
                $path = 'images/'.$_FILES['uploaded_file']['name'];
                $InWebRootPathAndOriginalFileName = 'images/'.$_FILES['uploaded_file']['name'];
                if($debug){echo "path: ".$InWebRootPathAndOriginalFileName."<br>";}
                // Ive used $_FILES and move_uploaded_file() to put the uploaded files into the right directory, 
                // These functions prevent file name injections caused by register_globals
                // also we change the same to a random string to prevent filename injection
                if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $InWebRootPathAndOriginalFileName)) {
                    $OriginalFileName = basename( $_FILES['uploaded_file']['name']);
                    $name = "";
                    if($debug){echo "The file ". $name .  " has been uploaded";}
                    
                    // 7 - run virus total api to scan for malware
                    $resultsFromVC = VirusTotalFileCheck($InWebRootPathAndOriginalFileName);
                   if($debug){ echo "<pre>";
                    print_r($resultsFromVC);}
                    $recponceCode = $resultsFromVC["response_code"];
                    $sha256 = $resultsFromVC["sha256"];
                    //  $recponceCode =  0 present and it could be retrieved                    
                    //  $recponceCode =  1 not present in VirusTotal's dataset
                    //  $recponceCode = -2 still queued for analysis
                    if($recponceCode = 0){
                        //can be retrived
                        // VirusTotalCheckHashOfSubmitedFile() returns true if file is clean or false if it is malware
                        if(VirusTotalCheckHashOfSubmitedFile($sha256)){
                            // 6 - change the file name
                            $ext=substr($OriginalFileName,strrpos($OriginalFileName,'.')+1);
                            $newFileName = bin2hex(random_bytes(8));
                            copy("images/".$OriginalFileName,"../../images/".$newFileName.".".$ext);
                            if($debug){echo "uploaded and has a clean responce from virus total";}
                            unlink("images/".$OriginalFileName);
                        }else{
                            // contains malware
                            unlink("images/".$OriginalFileName);
                            if($debug){echo "danger danger Will Robinson!";}
                        }
                    }else{
                        // cannot be received
                        // 6 - change the file name
                        $ext=substr($OriginalFileName,strrpos($OriginalFileName,'.')+1);
                        $newFileName = bin2hex(random_bytes(8));
                        copy("images/".$OriginalFileName,"../../images/".$newFileName.".".$ext);
                        if($debug){echo "uploaded and Qd with virus total - no signature ";}
                        unlink("images/".$OriginalFileName);
                    }
                } else{
                    if($debug){echo "There was an error uploading the file, please try again!";}
                }
            }
        }
        
        
        
    }
     

  /*
   * response_code: if the item you searched for was not present in VirusTotal's dataset this result will be 0. 
   * If the requested item is still queued for analysis it will be -2. 
   * If the item was indeed present and it could be retrieved it will be 1. 
   * Any other case is detailed in the full reference.
   */
  
  //VirusTotalFileCheck($path);
  // $filehash = "40dbdc0bdf5218af50741ba011c5286a723fa9bf";
  // if(VirusTotalCheckHashOfSubmitedFile($filehash)){
  //   echo "file clean";
  // }else{
  //   echo "danger";
  // }
  
  //sha1_file();
    //echo"<br>";
   // VirusTotalCheckHashOfSubmitedFile('92feddebe48a733a0136b1bce022aeedbd71013b6341e7a5b9019f2919f7a5f8');
    
    /* - example of array returned from a clean file
    [scan_id] => 92feddebe48a733a0136b1bce022aeedbd71013b6341e7a5b9019f2919f7a5f8-1522231512
    [sha1] => 3cb12dbaee08caa7c481c3c7f23fb18713446032
    [resource] => 92feddebe48a733a0136b1bce022aeedbd71013b6341e7a5b9019f2919f7a5f8
    [response_code] => 1
    [scan_date] => 2018-03-28 10:05:12
    [permalink] => https://www.virustotal.com/file/92feddebe48a733a0136b1bce022aeedbd71013b6341e7a5b9019f2919f7a5f8/analysis/1522231512/
    [verbose_msg] => Scan finished, information embedded
    [total] => 58
    [positives] => 0
    [sha256] => 92feddebe48a733a0136b1bce022aeedbd71013b6341e7a5b9019f2919f7a5f8
    [md5] => 27e7eba7484ff7dd9065a3d53059fbf3
    */
    
?>