<?php 
    session_start();
    include('../includes/connectionStrings.php');
    if($_SESSION['user'] != null){
        if($_SESSION['browser'] != $_SERVER['HTTP_USER_AGENT'] && $_SESSION['ip'] != get_client_ip_env() && $_COOKIE['cookieId'] != $_SESSION['cookieId']) {
            header("Location: index.php");
        }
    }else{
        header("Location: index.php");
    }
    
    if(isset($_GET['file'])){
        $date = date_create();
        $UnisTimestamp = date_timestamp_get($date);
        $stegData = $_SESSION['user']."!!-".$_SESSION['ip']."-".$UnisTimestamp;
        
        $fileName = $_GET['file'];
        // ref: http://thedebuggers.com/image-steganography-hiding-text-using-php/
        include('functions.php');
        $string_to_be_hidden = $stegData;
        $stringLength = strlen($string_to_be_hidden);
        $fillerChars = 43 - $stringLength;
        // has to encode a exact amount of charicters, adds whitespace if $string_to_be_hidden is less than the amount
        for($i=0;$i<$fillerChars;$i++){
            $string_to_be_hidden .= ' ';
        }
        // changes string into binary
        $binaryString = toBinary($string_to_be_hidden);
        $binaryStringLength = strlen($binaryString);
        $image = $fileName;
        $im = imagecreatefromjpeg($image);
        // Changes the last binary bit from each pixel to one from $binaryString
        for($i=0;$i<$binaryStringLength;$i++){
          $y = $i;
          $rgb = imagecolorat($im,$i,$y);
          $r = ($rgb >>16) & 0xFF;
          $g = ($rgb >>8) & 0xFF;
          $b = $rgb & 0xFF;
          // changes last chars to binary
          $newB = toBinary($b);
          // replaces last bit with the one from the $binaryString
          $newB[strlen($newB)-1] = $binaryString[$i];
          // changes the binary back 
          $newB = bin2txt($newB);
          // adds the amended blue to the pixle
          $new_color = imagecolorallocate($im,$r,$g,$newB);
          imagesetpixel($im,$i,$y,$new_color);
        }
        imagepng($im,'new.png');
        imagedestroy($im);
        unlink($fileName);
        rename('new.png', $fileName);
        
        header("location: ../download.php?returnedFile=$fileName");
    }
?>