<?php
    session_start();
    if($_SESSION['browser'] != $_SERVER['HTTP_USER_AGENT'] && $_SESSION['ip'] != get_client_ip_env() && $_COOKIE['cookieId'] != $_SESSION['cookieId']) {
        header("Location: index.php");
    }
    
    /* 
     * ----------- Checks photos to be uploaded, calls virus total API and saves the outside the web root ------------------
     * There are several steps to this:
     * - checks user is logged in and authenticated
     * - Sets file size constraints in php.ini
     * - Checks if it is a image
     * - Checks file size
     * - Checks if it is a image (by ext)
     * - Checks if it is a image (by type)
     * - Saves the image to a temp directory
     * - Calls to the  virus total api to scan for malware
     * - Checks the responce from virus total
     * - Based on the responce it..
     * - A) Moves file outside the web directory to store
     * - B) delets file
     * - check if user is trusted
     * - update images table with prepaired statment
     * ---------------------------------------------------------------------------------------------------------------------
     */

    $debug = true;
    require_once('includes/connectionStrings.php');
    include('includes/virustotal.class.php');
    include('includes/virustotalFunctions.php');
    include('includes/Steganography.php');
    
    // 1 - only logged in user can upload file(session managment)
    
    // 2 - set file size
    ini_set('post_max_size', '40M');
    ini_set('upload_max_filesize', '40M');
    ini_set('max_file_uploads', 2);
    
    
    // 3 - check if it is a image
    if(@is_array(getimagesize($_FILES['uploaded_file']['tmp_name']))){
        if($debug){echo "is a image<br>";
        echo "name: ".$_FILES['uploaded_file']['name']."<br>";
        echo "size ".$_FILES['uploaded_file']['size']."<br>";
        print_r($_FILES['uploaded_file']);}

        // 4 - check file size
        if ($_FILES['uploaded_file']['size'] > 400000){
            if($debug){echo "file too large";}
            // handel error
        }else{
            // 5 - check if it is a image (by ext)
            if(!empty($_FILES['uploaded_file'])){
                $path = "images/";
                $ext = (explode(".", $_FILES['uploaded_file']['name']));
                $ext = end($ext);
                if($debug){echo $ext."<br>";}
                
                // 6 - check if it is a image (by type)
                $allowed_types = ['image/jpg', 'image/png', 'image/jpeg', 'image/gif']; 
                if (!in_array($_FILES['uploaded_file']['type'], $allowed_types)) {
                    die();
                    // handel error
                }
                // 7 - Save to a temp file
                $path = 'images/'.$_FILES['uploaded_file']['name'];
                $InWebRootPathAndOriginalFileName = 'images/'.$_FILES['uploaded_file']['name'];
                if($debug){echo "path: ".$InWebRootPathAndOriginalFileName."<br>";}
                
                /*
                 * Ive used $_FILES and move_uploaded_file() to put the uploaded files into the right directory, 
                 * These functions prevent file name injections caused by register_globals
                 * also we change the same to a random string to prevent filename injection
                 */
                 
                if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $InWebRootPathAndOriginalFileName)) {
                    $OriginalFileName = basename( $_FILES['uploaded_file']['name']);
                    $name = "";
                    if($debug){echo "The file ". $name .  " has been uploaded";}
                    
                    // 8 - run virus total api to scan for malware
                    $resultsFromVC = VirusTotalFileCheck($InWebRootPathAndOriginalFileName);
                   if($debug){ echo "<pre>";
                    print_r($resultsFromVC);}
                    $recponceCode = $resultsFromVC["response_code"];
                    $sha256 = $resultsFromVC["sha256"];
                    
                    /*
                     *  $recponceCode =  0 present and it could be retrieved                    
                     *  $recponceCode =  1 not present in VirusTotal's dataset
                     *  $recponceCode = -2 still queued for analysis
                     */
                     
                    // 9 - check responce
                    // $recponceCode = 0 indicates there is a existing report of that file
                    if($recponceCode = 0){
                        // VirusTotalCheckHashOfSubmitedFile() returns true if file is clean or false if it is malware
                        if(VirusTotalCheckHashOfSubmitedFile($sha256)){
                            // 10 - change the file name
                            $ext=substr($OriginalFileName,strrpos($OriginalFileName,'.')+1);
                            $newFileName = bin2hex(random_bytes(8));
                            // 11 - Save file outside web directory 
                            copy("images/".$OriginalFileName,"../images/".$newFileName.".".$ext);
                            if($debug){echo "uploaded and has a clean responce from virus total";}
                            // 12 - remove temp file
                            unlink("images/".$OriginalFileName);
                        }else{
                            // contains malware
                            unlink("images/".$OriginalFileName);
                            if($debug){echo "danger danger Will Robinson!";}
                        }
                    }else{
                        // cannot be received
                        // 10 - change the file name
                        $ext=substr($OriginalFileName,strrpos($OriginalFileName,'.')+1);
                        $newFileName = bin2hex(random_bytes(8));
                        // 11 - Save file outside web directory 
                        copy("images/".$OriginalFileName,"../images/".$newFileName.".".$ext);
                        if($debug){echo "uploaded and Qd with virus total - no signature ";}
                        // 12 - remove temp file
                        unlink("images/".$OriginalFileName);
                        // 13 - insert to database
                        // 14 - check if user is trusted
                        if(isset($_SESSION['unTrustedUser'])){
                            // INSERT INTO images (filename, hash, owner, virusFree) VALUES (?,?,?,?)
                            // $dir, $ufilename, $uhash, $uowner, $uvirusFree, $expectedResult
                            if(!insert_prepared_imageUploadTransaction("", $newFileName.".".$ext, $sha256, $_SESSION['user'], 0, 1)){
                                // handel
                            }
                        }else{
                            // INSERT INTO images (filename, hash, owner, virusFree) VALUES (?,?,?,?)
                            // $dir, $ufilename, $uhash, $uowner, $uvirusFree, $expectedResult
                            if(!insert_prepared_imageUpload("", $newFileName.".".$ext, $sha256, $_SESSION['user'], 0, 1)){
                                $_SESSION['unTrustedUser'] = true;
                            }
                        }
                        
                        //header('location: ../welcome.php');
                    }
                } else{
                    if($debug){echo "There was an error uploading the file, please try again!";}
                }
            }
        }
    }
    
    //steganographyEncrypt();
    //steganographyDecrypt();
    //steganographyEncrypt2();
    
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
