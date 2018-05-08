    <?php 
        ob_start();
        include('functions.php');
        $file = $_GET['file'];
        $filepath = "../fileIO/".$file;
        //ref: http://thedebuggers.com/image-steganography-hiding-text-using-php/
        //$im = imagecreatefrompng($filepath);
        
        $size = getimagesize($filepath); 
        // 8 - uses correct create image function based on file type
        if($size['mime']=='image/png'){
            // png
            $im = imagecreatefrompng($filepath);
        }else{
            // jpeg and jpg
            $im = imagecreatefromjpeg($filepath);
        }
        
        $BinaryString = "";
        for($i=0; $i<344; $i++){
          $y = $i;
          $rgb = imagecolorat($im, $i, $y);
          $r = ($rgb >> 16) & 0xFF;
          $g = ($rgb >> 8) & 0xFF;
          $b = $rgb & 0xFF;
          
          $blue = toBinary($b);
          $BinaryString .= $blue[strlen($blue)-1];

        }
        // https://stackoverflow.com/questions/6497685/how-do-i-detect-non-ascii-characters-in-a-string
        $final = trim(bin2txt($BinaryString));
        
        if(preg_match('/[^\x20-\x7f]/', $final)){
            header('location: ../view/vendor/requestScanResult.php?result=null');
            exit();
        }
        
        
        if(!preg_match('/[^\x20-\x7f]/', $final)){
            header('location: ../view/vendor/requestScanResult.php?result='.$final);
            exit();
        }
        
        
    ?>