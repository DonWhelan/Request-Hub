<?php 
    session_start();
    include('../model/connectionStrings.php');
    include('../includes/mcrypt.php');
    // 1 - Authenticated user through session managment
    if($_SESSION['user'] != null){
        if($_SESSION['browser'] != $_SERVER['HTTP_USER_AGENT'] || $_SESSION['ip'] != get_client_ip_env() || $_COOKIE['cookieId'] != $_SESSION['cookieId']) {
            header("Location: ../index.php");
        }
    }else{
        header("Location: ../index.php");
    }
    
    /* 
     * --------------------------- takes photos and digitally imprints them using steganography ---------------------------
     * - Authenticated user through session managment
     * - Checks file is set
     * - Creates imprint [user,ip,timstamp]
     * - Get string length
     * - Adds whitespace as a buffer as max messege size is defined
     * - Decrypts files
     * - Gets size array (to check image type)
     * - Uses correct create image function based on file type
     * - Loops through pixels of image
     * - breaks pixel into red, green and blue
     * - Changes last blue chars to binary
     * - Replaces last bit with the one from the $binaryString
     * - Changes the binary back 
     * - Adds the amended blue to the pixle
     * - Creates the new image and replaces the old
     * - Sets header back to download.php
     * ---------------------------------------------------------------------------------------------------------------------
     */
    
    // 2 - checks file is set
    if(isset($_GET['file'])){
        $date = date_create();
        $UnisTimestamp = date_timestamp_get($date);
        // 3 - Creates imprint [user,ip,timstamp]
        $stegData = $_SESSION['user']."-".$_SESSION['ip']."-".$UnisTimestamp;
        $fileName = $_GET['file'];
        // 4 - decrypts files
        $originalContents = file_get_contents($fileName);
        $encryptedContents = mcryptDecrypt($key,$originalContents);
        file_put_contents($fileName,$encryptedContents);
        // ref: http://thedebuggers.com/image-steganography-hiding-text-using-php/
        include('functions.php');
        $string_to_be_hidden = $stegData;
        // 5 - Get string length
        $stringLength = strlen($string_to_be_hidden);
        // 6 - Adds whitespace as a buffer as max messege size is defined
        $fillerChars = 43 - $stringLength;
        // has to encode a exact amount of charicters, adds whitespace if $string_to_be_hidden is less than the amount
        for($i=0;$i<$fillerChars;$i++){
            $string_to_be_hidden .= ' ';
        }
        // changes string into binary
        $binaryString = toBinary($string_to_be_hidden);
        $binaryStringLength = strlen($binaryString);
        $image = $fileName;
        // 7 - Gets size array (to check image type)
        $size = getimagesize($image); 
        // 8 - uses correct create image function based on file type
        if($size['mime']=='image/png'){
            // png
            $im = imagecreatefrompng($image);
        }else{
            // jpeg and jpg
            $im = imagecreatefromjpeg($image);
        }
        // 9 - loops through pixels of image
        for($i=0;$i<$binaryStringLength;$i++){
            $y = $i;
            // 10 - breaks pixel into red, green and blue
            $rgb = imagecolorat($im,$i,$y);
            $r = ($rgb >>16) & 0xFF;
            $g = ($rgb >>8) & 0xFF;
            $b = $rgb & 0xFF;
            // 11 - changes last blue chars to binary
            $newB = toBinary($b);
            // 12 - replaces last bit with the one from the $binaryString
            $newB[strlen($newB)-1] = $binaryString[$i];
            // 13 - changes the binary back 
            $newB = bin2txt($newB);
            // 14 - adds the amended blue to the pixle
            $new_color = imagecolorallocate($im,$r,$g,$newB);
            imagesetpixel($im,$i,$y,$new_color);
        }
        // 15 - creates the new image and replaces the old
        imagepng($im,'new.png');
        imagedestroy($im);
        unlink($fileName);
        rename('new.png', $fileName);
        // 16- sets header back to download.php
        header("location: ../fileIO/download.php?returnedFile=$fileName");
    }
?>