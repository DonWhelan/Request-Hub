<?php 

    session_start();
    // Force download of image file specified in URL query string and which
    // is in the same directory as the download.php script.
    // ref: https://stackoverflow.com/questions/11090272/how-can-i-force-an-image-download-in-the-browser
    // ?file=db621adc1be58203.jpg
        
    if($_SESSION['user'] != null){
        if($_SESSION['browser'] != $_SERVER['HTTP_USER_AGENT'] && $_SESSION['ip'] != get_client_ip_env() && $_COOKIE['cookieId'] != $_SESSION['cookieId']) {
            header("Location: index.php");
        }
    }else{
        header("Location: index.php");
    } 
    if(empty($_GET['file']) && empty($_GET['returnedFile'])) {
      header("HTTP/1.0 404 Not Found");
      return;
    }

    // /* --  working download -- */
    
    if(!empty($_GET['file'])){
        $fileName = basename($_GET['file']);
        $filePath = '../images/'.$fileName;
        if(!empty($fileName) && file_exists($filePath)){
            // // Define headers
            // header("Cache-Control: public");
            // header("Content-Description: File Transfer");
            // header("Content-Disposition: attachment; filename=$fileName");
            // header("Content-Type: application/zip");
            // header("Content-Transfer-Encoding: binary");
            
            // // Read the file
            // readfile($filePath);
            //exit;
            copy($filePath , "Steganography/".$fileName);
            header("location: Steganography/encrypt.php?file=$fileName");
        }else{
            echo 'The file does not exist.';
        }

    }
    
    if(!empty($_GET['returnedFile'])){
        $fileName = basename($_GET['returnedFile']);
        $filePath = 'Steganography/'.$fileName;
        if(!empty($fileName) && file_exists($filePath)){
            // Define headers
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$fileName");
            header("Content-Type: application/zip");
            header("Content-Transfer-Encoding: binary");
            
            // Read the file
            readfile($filePath);
            exit;
        }else{
            echo 'The file does not exist.';
        }
    }
?>