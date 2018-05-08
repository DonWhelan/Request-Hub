<?php
    session_start();
    include('../model/connectionStrings.php');
    if($_SESSION['user'] != null){
        if($_SESSION['browser'] != $_SERVER['HTTP_USER_AGENT'] || $_SESSION['ip'] != get_client_ip_env() || $_COOKIE['cookieId'] != $_SESSION['cookieId']) {
            header("Location: index.php");
        }
    }else{
        header("Location: index.php");
    }
    
    /* 
     * ----------- Checks photos to be uploaded, calls virus total API and saves file outside the web root ------------------
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
     * - Based on the responce it...
     * - A) Moves file outside the web directory to store and Encrypts contents of file
     * - B) delets file
     * - check if user is trusted
     * - update images table with prepaired statment
     * ---------------------------------------------------------------------------------------------------------------------
     */

    $debug = true;
    require_once('../model/connectionStrings.php');
    include('../includes/virustotal.class.php');
    include('../includes/virustotalFunctions.php');
    include('../includes/Steganography.php');
    include('../includes/mcrypt.php');
    
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
        if ($_FILES['uploaded_file']['size'] > 2000000){
            if($debug){echo "file too large";}
            // handel error
        }else{
            // 5 - check if it is a image (by ext)
            if(!empty($_FILES['uploaded_file'])){
                $path = "../images/";
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
                $path = '../../../Steganography/'.$_FILES['uploaded_file']['name'];
               
                $InWebRootPathAndOriginalFileName = '../Steganography/'.$_FILES['uploaded_file']['name'];
                move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $InWebRootPathAndOriginalFileName);
                echo $InWebRootPathAndOriginalFileName;
                rename($InWebRootPathAndOriginalFileName,"temp.".$ext);
                header('location: ../Steganography/decrypt.php?file=temp.'.$ext);
            }
        }
    }
?>
