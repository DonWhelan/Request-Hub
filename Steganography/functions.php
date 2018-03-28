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
    
  ?>