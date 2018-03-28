<?php

    //ref: http://thedebuggers.com/image-steganography-hiding-text-using-php/
    function toBinary($str){
      $str = (string)$str;
      $l = strlen($str);
      $result = '';
      while($l--){
        $result = str_pad(decbin(ord($str[$l])),8,"0",STR_PAD_LEFT).$result;
      }
      return $result;
    }
        
    function toString($binary){
      return pack('H*',base_convert($binary,2,16));
    }
      
    //ref: http://board.phpbuilder.com/showthread.php?10229240-ascii-value-to-8-bit-binary-value
    function bin2txt($str) {
      $text_array = explode("\r\n", chunk_split($str, 8));
      $newstring = '';
      for ($n = 0; $n < count($text_array) - 1; $n++) {
        $newstring .= chr(base_convert($text_array[$n], 2, 10));
      }
      return $newstring; 
    }
    
    function steganographyEncrypt(){
        // ref: http://thedebuggers.com/image-steganography-hiding-text-using-php/
        $string_to_be_hidden = 'yoyo';
        $stringLength = strlen($string_to_be_hidden);
        $fillerChars = 11 - $stringLength;
        // has to encode a exact amount of charicters, adds whitespace if $string_to_be_hidden is less than the amount
        for($i=0;$i<$fillerChars;$i++){
            $string_to_be_hidden .= ' ';
        }
        // changes string into binary
        $binaryString = toBinary($string_to_be_hidden);
        $binaryStringLength = strlen($binaryString);
        $image = 'grizzly-bear2.jpg';
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
        imagepng($im,'steg.png');
        imagedestroy($im);
    }
    
    function steganographyEncrypt2(){
        // ref: http://thedebuggers.com/image-steganography-hiding-text-using-php/
        $user = 'Don';
        $action = "u";
        $date = date_create();
        $UnixTimeStamp = date_timestamp_get($date);
        $from = "123.123.123.123";
        $string_to_be_hidden = $user."-".$action."-".$from."-".$UnixTimeStamp;
        $stringLength = strlen($string_to_be_hidden);
        echo $stringLength;
        $fillerChars = 43 - $stringLength;
        // has to encode a exact amount of charicters, adds whitespace if $string_to_be_hidden is less than the amount
        for($i=0;$i<$fillerChars;$i++){
            $string_to_be_hidden .= ' ';
        }
        // changes string into binary
        $binaryString = toBinary($string_to_be_hidden);
        $binaryStringLength = strlen($binaryString);
        $image = 'grizzly-bear2.jpg';
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
        imagepng($im,'steg.png');
        imagedestroy($im);
    }
    
    function steganographyDecrypt(){
        $image = 'steg.png';
        $im = imagecreatefrompng($image);
        $BinaryString = "";
        //for($i=0; $i<88; $i++){
        for($i=0; $i<344; $i++){
            $y = $i;
            $rgb = imagecolorat($im, $i, $y);
            $r = ($rgb >> 16) & 0xFF;
            $g = ($rgb >> 8) & 0xFF;
            $b = $rgb & 0xFF;
          
            $blue = toBinary($b);
            $BinaryString .= $blue[strlen($blue)-1];
        }
        echo  trim(bin2txt($BinaryString));
    }
?>