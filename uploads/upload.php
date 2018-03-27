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
  require_once('../connectionStrings.php');
  require_once('virustotal.class.php');
  // VirusTotalFileCheck($path);
  // VirusTotalCheckHashOfSubmitedFile($hash);
  
  
  
  if(!empty($_FILES['uploaded_file']))
  {
    $path = "images/";
    $newFileName = bin2hex(random_bytes(8));
    $path = $path . $newFileName . ".php";
    // Ive used $_FILES and move_uploaded_file() to put the uploaded files into the right directory, 
    // Then checked with is_uploaded_file(). 
    // These functions prevent file name injections caused by register_globals
    // also we change the same to a random string to prevent filename injection
    if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path)) {
      $name = basename( $_FILES['uploaded_file']['name']);
      $ext = end((explode(".", $name)));
      echo "The file ". $name .  " has been uploaded";
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
  
  //VirusTotalFileCheck($path);
  // $filehash = "40dbdc0bdf5218af50741ba011c5286a723fa9bf";
  // if(VirusTotalCheckHashOfSubmitedFile($filehash)){
  //   echo "file clean";
  // }else{
  //   echo "danger";
  // }
  
  //sha1_file();

    
?>