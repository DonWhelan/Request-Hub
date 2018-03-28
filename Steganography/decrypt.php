    <?php 
        //ref: http://thedebuggers.com/image-steganography-hiding-text-using-php/
        include('functions.php');
        $image = 'steg.png';
        $im = imagecreatefrompng($image);
        $BinaryString = "";
        for($i=0; $i<88; $i++){
          $y = $i;
          $rgb = imagecolorat($im, $i, $y);
          $r = ($rgb >> 16) & 0xFF;
          $g = ($rgb >> 8) & 0xFF;
          $b = $rgb & 0xFF;
          
          $blue = toBinary($b);
          $BinaryString .= $blue[strlen($blue)-1];
        }
        echo  trim(bin2txt($BinaryString));
    ?>