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
     * -------------- call images from outside the web root to be displayed on the webside in <img>'s ---------------------
     * - Checks user is logged in and authenticated
     * - Checks that 'file' has been passed via $_GET
     * - Handels '../' to mitigate directory traversal - produces 404
     * - Adds the path type to the 'file'
     * - Returns teh image using readfile()
     * ---------------------------------------------------------------------------------------------------------------------
     */

    // 2 - Checks that 'file' has been passed via $_GET
    if(empty($_GET['file'])) {
      header("HTTP/1.0 404 Not Found");
      exit;
    }
    
    if(!empty($_GET['file'])){
        // 3 - Handels '../' to mitigate directory traversal - produces 404
        if (strpos($_GET['file'], '../') !== false) {
            header("HTTP/1.0 404 Not Found");
        }else{
            
            // ref https://stackoverflow.com/questions/27402572/how-to-echo-image-that-is-outside-of-the-public-folder
            
            /*
             * By storing the image out of the web root and having to run the below script to call it into the web root again, 
             * It means I can re-authenticate users before the image is issued. so only logged in users can call images from the site
             * If the images are stored in the web root direct links to the image would display them without the user haveing to log in
             */
            
            // 4 - Adds the path type to the 'file' 
            $mime_type = mime_content_type("../images/{$_GET['file']}");
            header('Content-Type: '.$mime_type);
            // 5 - Returns teh image using readfile()
            readfile("../images/{$_GET['file']}");
        } 
        exit;
    }
    // <img src="file.php?file=photo.jpg" />
?>    