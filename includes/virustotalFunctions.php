<?php
//ref: https://www.virustotal.com/en/documentation/public-api/
function VirusTotalFileCheck($path){  
        global $debug;
        $file_name_with_full_path = realpath($path);
        $api_key = getenv('VT_API_KEY') ? getenv('VT_API_KEY') :'62ce324bb90c77befcd8c11b46869b2c8274e81544de94d9896e3ea6497c1826';
        $cfile = curl_file_create($file_name_with_full_path);
         
        $post = array('apikey' => $api_key,'file'=> $cfile);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.virustotal.com/vtapi/v2/file/scan');
        curl_setopt($ch, CURLOPT_POST, True);
        curl_setopt($ch, CURLOPT_VERBOSE, 1); // remove this if your not debugging
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate'); // please compress data
        curl_setopt($ch, CURLOPT_USERAGENT, "gzip, My php curl client");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER ,True);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
         
        $result=curl_exec ($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if($debug){print("status = $status_code\n");}
        if ($status_code == 200) { // OK
            $js = json_decode($result, true);
            //debug
               
            if($debug){echo "<pre>";}
            if($debug){print_r($js);}
            $rc = $js["response_code"];
            $sha256 = $js["sha256"];
            $array = [];
            $array = ["response_code" => $rc, "sha256" => $sha256];
            return $array;
            
        } else {  // Error occured
            print($result);
        }
        curl_close ($ch);
    }
  
    function VirusTotalCheckHashOfSubmitedFile($hash){
        $post = array('apikey' => '62ce324bb90c77befcd8c11b46869b2c8274e81544de94d9896e3ea6497c1826','resource'=>$hash);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.virustotal.com/vtapi/v2/file/report');
        curl_setopt($ch, CURLOPT_POST,1);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate'); // please compress data
        curl_setopt($ch, CURLOPT_USERAGENT, "gzip, My php curl client");
        curl_setopt($ch, CURLOPT_VERBOSE, 1); // remove this if your not debugging
        curl_setopt($ch, CURLOPT_RETURNTRANSFER ,true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
         
        $result = curl_exec ($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($status_code == 200) { // OK
          $js = json_decode($result, true);
           if($debug){echo "<pre>";}
           if($debug){print_r($js);}
          if($js["positives"]==0){
              // clean
            return true;
          }else{
              // malware
            return false;
          }
        } else {  // Error occured
          print($result);
        }
        curl_close ($ch);
    }
    
    function encrypt(){
        //ref: http://thedebuggers.com/image-steganography-hiding-text-using-php/
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
    }
  
  ?>