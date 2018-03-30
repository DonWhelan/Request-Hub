{"filter":false,"title":"functions.php","tooltip":"/Steganography/functions.php","ace":{"folds":[],"scrolltop":0,"scrollleft":0,"selection":{"start":{"row":1,"column":0},"end":{"row":24,"column":5},"isBackwards":true},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":0},"hash":"ba0abd11faee88c4badad0b41c8b21f2325b7359","undoManager":{"mark":0,"position":0,"stack":[[{"start":{"row":0,"column":0},"end":{"row":26,"column":4},"action":"insert","lines":["  <?php ","    //ref: http://thedebuggers.com/image-steganography-hiding-text-using-php/","    function toBinary($str){","      $str = (string)$str;","      $l = strlen($str);","      $result = '';","      while($l--){","        $result = str_pad(decbin(ord($str[$l])),8,\"0\",STR_PAD_LEFT).$result;","      }","      return $result;","    }","        ","    function toString($binary){","      return pack('H*',base_convert($binary,2,16));","    }","      ","    //ref: http://board.phpbuilder.com/showthread.php?10229240-ascii-value-to-8-bit-binary-value","    function bin2txt($str) {","      $text_array = explode(\"\\r\\n\", chunk_split($str, 8));","      $newstring = '';","      for ($n = 0; $n < count($text_array) - 1; $n++) {","        $newstring .= chr(base_convert($text_array[$n], 2, 10));","      }","      return $newstring; ","    }","    ","  ?>"],"id":1}]]},"timestamp":1522235869552}