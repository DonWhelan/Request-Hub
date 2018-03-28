{"filter":false,"title":"virustoatalFunctions.php","tooltip":"/includes/virustoatalFunctions.php","undoManager":{"mark":8,"position":8,"stack":[[{"start":{"row":0,"column":0},"end":{"row":65,"column":3},"action":"insert","lines":["function VirusTotalFileCheck($path){  ","        global $debug;","        $file_name_with_full_path = realpath($path);","        $api_key = getenv('VT_API_KEY') ? getenv('VT_API_KEY') :'62ce324bb90c77befcd8c11b46869b2c8274e81544de94d9896e3ea6497c1826';","        $cfile = curl_file_create($file_name_with_full_path);","         ","        $post = array('apikey' => $api_key,'file'=> $cfile);","        $ch = curl_init();","        curl_setopt($ch, CURLOPT_URL, 'https://www.virustotal.com/vtapi/v2/file/scan');","        curl_setopt($ch, CURLOPT_POST, True);","        curl_setopt($ch, CURLOPT_VERBOSE, 1); // remove this if your not debugging","        curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate'); // please compress data","        curl_setopt($ch, CURLOPT_USERAGENT, \"gzip, My php curl client\");","        curl_setopt($ch, CURLOPT_RETURNTRANSFER ,True);","        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);","         ","        $result=curl_exec ($ch);","        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);","        if($debug){print(\"status = $status_code\\n\");}","        if ($status_code == 200) { // OK","            $js = json_decode($result, true);","            //debug","               ","            if($debug){echo \"<pre>\";}","            if($debug){print_r($js);}","            $rc = $js[\"response_code\"];","            $sha256 = $js[\"sha256\"];","            $array = [];","            $array = [\"response_code\" => $rc, \"sha256\" => $sha256];","            return $array;","            ","        } else {  // Error occured","            print($result);","        }","        curl_close ($ch);","    }","  ","  function VirusTotalCheckHashOfSubmitedFile($hash){","    $post = array('apikey' => '62ce324bb90c77befcd8c11b46869b2c8274e81544de94d9896e3ea6497c1826','resource'=>$hash);","    $ch = curl_init();","    curl_setopt($ch, CURLOPT_URL, 'https://www.virustotal.com/vtapi/v2/file/report');","    curl_setopt($ch, CURLOPT_POST,1);","    curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate'); // please compress data","    curl_setopt($ch, CURLOPT_USERAGENT, \"gzip, My php curl client\");","    curl_setopt($ch, CURLOPT_VERBOSE, 1); // remove this if your not debugging","    curl_setopt($ch, CURLOPT_RETURNTRANSFER ,true);","    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);","     ","    $result = curl_exec ($ch);","    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);","    if ($status_code == 200) { // OK","      $js = json_decode($result, true);","       if($debug){echo \"<pre>\";}","       if($debug){print_r($js);}","      if($js[\"positives\"]==0){","          // clean","        return true;","      }else{","          // malware","        return false;","      }","    } else {  // Error occured","      print($result);","    }","    curl_close ($ch);","  }"],"id":1}],[{"start":{"row":0,"column":0},"end":{"row":1,"column":0},"action":"insert","lines":["",""],"id":2}],[{"start":{"row":0,"column":0},"end":{"row":0,"column":1},"action":"insert","lines":["<"],"id":3},{"start":{"row":0,"column":1},"end":{"row":0,"column":2},"action":"insert","lines":["/"]}],[{"start":{"row":0,"column":1},"end":{"row":0,"column":2},"action":"remove","lines":["/"],"id":4}],[{"start":{"row":0,"column":1},"end":{"row":0,"column":2},"action":"insert","lines":["?"],"id":5},{"start":{"row":0,"column":2},"end":{"row":0,"column":3},"action":"insert","lines":["p"]},{"start":{"row":0,"column":3},"end":{"row":0,"column":4},"action":"insert","lines":["h"]},{"start":{"row":0,"column":4},"end":{"row":0,"column":5},"action":"insert","lines":["p"]}],[{"start":{"row":0,"column":5},"end":{"row":1,"column":0},"action":"insert","lines":["",""],"id":6}],[{"start":{"row":67,"column":3},"end":{"row":68,"column":0},"action":"insert","lines":["",""],"id":7},{"start":{"row":68,"column":0},"end":{"row":68,"column":2},"action":"insert","lines":["  "]},{"start":{"row":68,"column":2},"end":{"row":69,"column":0},"action":"insert","lines":["",""]},{"start":{"row":69,"column":0},"end":{"row":69,"column":2},"action":"insert","lines":["  "]},{"start":{"row":69,"column":2},"end":{"row":69,"column":3},"action":"insert","lines":["?"]},{"start":{"row":69,"column":3},"end":{"row":69,"column":4},"action":"insert","lines":["."]}],[{"start":{"row":69,"column":3},"end":{"row":69,"column":4},"action":"remove","lines":["."],"id":8}],[{"start":{"row":69,"column":3},"end":{"row":69,"column":4},"action":"insert","lines":[">"],"id":9}]]},"ace":{"folds":[],"scrolltop":0,"scrollleft":0,"selection":{"start":{"row":68,"column":2},"end":{"row":68,"column":2},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":0},"timestamp":1522239684035,"hash":"c7d470146bc3bcb16e2fc6224bf79a45e0971815"}