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

  if(!empty($_FILES['uploaded_file']))
  {
    $path = "images/";
    $newFileName = bin2hex(random_bytes(8));
    $path = $path . $newFileName . ".jpg";
    if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path)) {
      echo "The file ".  basename( $_FILES['uploaded_file']['name']). 
      " has been uploaded";
    } else{
        echo "There was an error uploading the file, please try again!";
    }
  }
echo "<br>";
  /*
   * response_code: if the item you searched for was not present in VirusTotal's dataset this result will be 0. 
   * If the requested item is still queued for analysis it will be -2. 
   * If the item was indeed present and it could be retrieved it will be 1. 
   * Any other case is detailed in the full reference.
   */
   
  require_once('virustotal.class.php');
  
  function VirusTotalFileCheck($path){  
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
    print("status = $status_code\n");
    if ($status_code == 200) { // OK
      $js = json_decode($result, true);
      echo "<pre>";
      print_r($js);
      echo "<br>";
      echo "responce code: ".$js["response_code"]."<br>";
      if($js["response_code"]==1)echo"not present in VirusTotal's dataset";
      if($js["response_code"]==0)echo"present and it could be retrieved";
      if($js["response_code"]==-2)echo"still queued for analysis";
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
    //print("status = $status_code\n");
    if ($status_code == 200) { // OK
      $js = json_decode($result, true);
      if($js["positives"]==0){
        return true;
      }else{
        return false;
      }
      //print_r($js);
    } else {  // Error occured
      print($result);
    }
    curl_close ($ch);
  }
  //VirusTotalFileCheck($path);
  $filehash = "09021ad4c4b09a27361816af02c9ae7508d41ff9";
  if(VirusTotalCheckHashOfSubmitedFile($filehash)){
    echo "file clean";
  }else{
    echo "danger";
  }
 

?>