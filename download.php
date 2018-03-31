<?php 
    session_start();
    // 1 Sessions managment - redirects user to index if not logged in
    if($_SESSION['user'] != null){
        if($_SESSION['browser'] != $_SERVER['HTTP_USER_AGENT'] && $_SESSION['ip'] != get_client_ip_env() && $_COOKIE['cookieId'] != $_SESSION['cookieId']) {
            header("Location: index.php");
            exit;
        }
    }else{
        header("Location: index.php");
        exit;
    }
    
    /* 
     * ------------ Calls images from outside the web root to be downloaded to users while digitaly inprinted them ---------------------
     * - Sessions managment
     * - Checks that 'file' and 'returnedFile' has been passed via $_GET
     * - Handles '../' to mitigate directory traversal - produces 404
     * - Adds the path type to the 'file'
     * - Copys the image to the Steganography directory
     * - Calls the encrypt.php scripts which user Steganography to inprint the downloading users info 
     * - (/-- encrypt.php then returns 'returnedFile' which is imprinted --/)
     * - Checks for invalid charicters in the file name
     * - Adds the path type to the 'returnedFile'
     * - Define headers for the download
     * - Reads the file and returns it to the browser for download
     * --------------------------------------------------------------------------------------------------------------------------------
     */
    
    // 2 - Checks that 'file' and 'returnedFile' has been passed via $_GET
    if(empty($_GET['file']) && empty($_GET['returnedFile'])) {
      header("HTTP/1.0 404 Not Found");
      return;
    }
    
    /*
     * - If the input is 'file' is sent to be digitally inprinted
     */
     
    if(!empty($_GET['file'])){
        // 3 - Handels '../' to mitigate directory traversal - produces 404
        if (strpos($_GET['file'], '../') !== false) {
            header("HTTP/1.0 404 Not Found");
        }else{
            $fileName = basename($_GET['file']);
            // 4 - Adds the path type to the 'file'
            $filePath = '../images/'.$fileName;
            if(!empty($fileName) && file_exists($filePath)){
                // 5 - Copys the image to the Steganography directory
                copy($filePath , "Steganography/".$fileName);
                // 6 - Calls the encrypt.php scripts which user Steganography to inprint the downloading users info 
                header("location: Steganography/encrypt.php?file=$fileName");
            }else{
                echo 'The file does not exist.';
            }
        }
    }
    
    /*
     * - If the input is 'returnedFile' is returned to the browser
     */
    
    if(!empty($_GET['returnedFile'])){
        if (strpos($_GET['returnedFile'], '../') !== false) {
            header("HTTP/1.0 404 Not Found");
        }else{
            // 7 - Checks for invalid charicters in the file name
            $fileName = basename($_GET['returnedFile']);
            // 8 - Adds the path type to the 'returnedFile'
            $filePath = 'Steganography/'.$fileName;
            if(!empty($fileName) && file_exists($filePath)){
                // 9 - Define headers - ref: https://stackoverflow.com/questions/11090272/how-can-i-force-an-image-download-in-the-browser
                header("Cache-Control: public");
                header("Content-Description: File Transfer");
                header("Content-Disposition: attachment; filename=$fileName");
                header("Content-Type: application/zip");
                header("Content-Transfer-Encoding: binary");
                // 10 - Reads the file
                readfile($filePath);
                exit;
            }else{
                echo 'The file does not exist.';
            }
        }
    }
?>