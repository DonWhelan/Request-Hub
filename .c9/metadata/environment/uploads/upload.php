{"changed":true,"filter":false,"title":"upload.php","tooltip":"/uploads/upload.php","value":"<!DOCTYPE html>\n<html>\n<head>\n  <title>Upload your files</title>\n</head>\n<body>\n  <form enctype=\"multipart/form-data\" action=\"upload.php\" method=\"POST\">\n    <p>Upload your file</p>\n    <input type=\"file\" name=\"uploaded_file\"></input><br />\n    <input type=\"submit\" value=\"Upload\"></input>\n  </form>\n</body>\n</html>\n<?PHP\n\n  if(!empty($_FILES['uploaded_file']))\n  {\n    $path = \"images/\";\n    $newFileName = bin2hex(random_bytes(8));\n    $path = $path . $newFileName . \".jpg\";\n    if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path)) {\n      echo \"The file \".  basename( $_FILES['uploaded_file']['name']). \n      \" has been uploaded\";\n    } else{\n        echo \"There was an error uploading the file, please try again!\";\n    }\n  }\necho \"<br>\";\n  /*\n   * response_code: if the item you searched for was not present in VirusTotal's dataset this result will be 0. \n   * If the requested item is still queued for analysis it will be -2. \n   * If the item was indeed present and it could be retrieved it will be 1. \n   * Any other case is detailed in the full reference.\n   */\n   \n  require_once('virustotal.class.php');\n  \n  function VirusTotalFileCheck($path){  \n    $file_name_with_full_path = realpath($path);\n    $api_key = getenv('VT_API_KEY') ? getenv('VT_API_KEY') :'62ce324bb90c77befcd8c11b46869b2c8274e81544de94d9896e3ea6497c1826';\n    $cfile = curl_file_create($file_name_with_full_path);\n     \n    $post = array('apikey' => $api_key,'file'=> $cfile);\n    $ch = curl_init();\n    curl_setopt($ch, CURLOPT_URL, 'https://www.virustotal.com/vtapi/v2/file/scan');\n    curl_setopt($ch, CURLOPT_POST, True);\n    curl_setopt($ch, CURLOPT_VERBOSE, 1); // remove this if your not debugging\n    curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate'); // please compress data\n    curl_setopt($ch, CURLOPT_USERAGENT, \"gzip, My php curl client\");\n    curl_setopt($ch, CURLOPT_RETURNTRANSFER ,True);\n    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);\n     \n    $result=curl_exec ($ch);\n    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);\n    print(\"status = $status_code\\n\");\n    if ($status_code == 200) { // OK\n      $js = json_decode($result, true);\n      echo \"<pre>\";\n      print_r($js);\n      echo \"<br>\";\n      echo \"responce code: \".$js[\"response_code\"].\"<br>\";\n      if($js[\"response_code\"]==1)echo\"not present in VirusTotal's dataset\";\n      if($js[\"response_code\"]==0)echo\"present and it could be retrieved\";\n      if($js[\"response_code\"]==-2)echo\"still queued for analysis\";\n    } else {  // Error occured\n      print($result);\n    }\n    curl_close ($ch);\n  }\n  \n  function VirusTotalCheckHashOfSubmitedFile($hash){\n    $post = array('apikey' => '62ce324bb90c77befcd8c11b46869b2c8274e81544de94d9896e3ea6497c1826','resource'=>$hash);\n    $ch = curl_init();\n    curl_setopt($ch, CURLOPT_URL, 'https://www.virustotal.com/vtapi/v2/file/report');\n    curl_setopt($ch, CURLOPT_POST,1);\n    curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate'); // please compress data\n    curl_setopt($ch, CURLOPT_USERAGENT, \"gzip, My php curl client\");\n    curl_setopt($ch, CURLOPT_VERBOSE, 1); // remove this if your not debugging\n    curl_setopt($ch, CURLOPT_RETURNTRANSFER ,true);\n    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);\n     \n    $result = curl_exec ($ch);\n    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);\n    //print(\"status = $status_code\\n\");\n    if ($status_code == 200) { // OK\n      $js = json_decode($result, true);\n      if($js[\"positives\"]==0){\n        return true;\n      }else{\n        return false;\n      }\n      //print_r($js);\n    } else {  // Error occured\n      print($result);\n    }\n    curl_close ($ch);\n  }\n  //VirusTotalFileCheck($path);\n  $filehash = \"09021ad4c4b09a27361816af02c9ae7508d41ff9\";\n  if(VirusTotalCheckHashOfSubmitedFile($filehash)){\n    echo \"file clean\";\n  }else{\n    echo \"danger\";\n  }\n  \n  sha1_file();\n \n\n?>","undoManager":{"mark":95,"position":100,"stack":[[{"start":{"row":86,"column":30},"end":{"row":86,"column":31},"action":"insert","lines":["}"],"id":632}],[{"start":{"row":86,"column":30},"end":{"row":88,"column":6},"action":"insert","lines":["","        ","      "],"id":633}],[{"start":{"row":87,"column":8},"end":{"row":87,"column":9},"action":"insert","lines":["r"],"id":634}],[{"start":{"row":87,"column":9},"end":{"row":87,"column":10},"action":"insert","lines":["e"],"id":635}],[{"start":{"row":87,"column":10},"end":{"row":87,"column":11},"action":"insert","lines":["t"],"id":636}],[{"start":{"row":87,"column":11},"end":{"row":87,"column":12},"action":"insert","lines":["u"],"id":637}],[{"start":{"row":87,"column":12},"end":{"row":87,"column":13},"action":"insert","lines":["r"],"id":638}],[{"start":{"row":87,"column":13},"end":{"row":87,"column":14},"action":"insert","lines":["n"],"id":639}],[{"start":{"row":87,"column":14},"end":{"row":87,"column":15},"action":"insert","lines":[" "],"id":640}],[{"start":{"row":87,"column":15},"end":{"row":87,"column":16},"action":"insert","lines":["t"],"id":641}],[{"start":{"row":87,"column":16},"end":{"row":87,"column":17},"action":"insert","lines":["r"],"id":642}],[{"start":{"row":87,"column":17},"end":{"row":87,"column":18},"action":"insert","lines":["u"],"id":643}],[{"start":{"row":87,"column":18},"end":{"row":87,"column":19},"action":"insert","lines":["e"],"id":644}],[{"start":{"row":87,"column":19},"end":{"row":87,"column":20},"action":"insert","lines":[";"],"id":645}],[{"start":{"row":88,"column":7},"end":{"row":88,"column":8},"action":"insert","lines":["e"],"id":646}],[{"start":{"row":88,"column":8},"end":{"row":88,"column":9},"action":"insert","lines":["l"],"id":647}],[{"start":{"row":88,"column":9},"end":{"row":88,"column":10},"action":"insert","lines":["s"],"id":648}],[{"start":{"row":88,"column":10},"end":{"row":88,"column":11},"action":"insert","lines":["e"],"id":649}],[{"start":{"row":88,"column":11},"end":{"row":88,"column":12},"action":"insert","lines":["{"],"id":650}],[{"start":{"row":88,"column":12},"end":{"row":88,"column":13},"action":"insert","lines":["}"],"id":651}],[{"start":{"row":88,"column":12},"end":{"row":90,"column":6},"action":"insert","lines":["","        ","      "],"id":652}],[{"start":{"row":89,"column":8},"end":{"row":89,"column":9},"action":"insert","lines":["r"],"id":653}],[{"start":{"row":89,"column":9},"end":{"row":89,"column":10},"action":"insert","lines":["e"],"id":654}],[{"start":{"row":89,"column":10},"end":{"row":89,"column":11},"action":"insert","lines":["t"],"id":655}],[{"start":{"row":89,"column":11},"end":{"row":89,"column":12},"action":"insert","lines":["u"],"id":656}],[{"start":{"row":89,"column":12},"end":{"row":89,"column":13},"action":"insert","lines":["r"],"id":657}],[{"start":{"row":89,"column":13},"end":{"row":89,"column":14},"action":"insert","lines":["n"],"id":658}],[{"start":{"row":89,"column":14},"end":{"row":89,"column":15},"action":"insert","lines":[" "],"id":659}],[{"start":{"row":89,"column":15},"end":{"row":89,"column":16},"action":"insert","lines":["f"],"id":660}],[{"start":{"row":89,"column":16},"end":{"row":89,"column":17},"action":"insert","lines":["a"],"id":661}],[{"start":{"row":89,"column":17},"end":{"row":89,"column":18},"action":"insert","lines":["l"],"id":662}],[{"start":{"row":89,"column":18},"end":{"row":89,"column":19},"action":"insert","lines":["s"],"id":663}],[{"start":{"row":89,"column":19},"end":{"row":89,"column":20},"action":"insert","lines":["e"],"id":664}],[{"start":{"row":89,"column":20},"end":{"row":89,"column":21},"action":"insert","lines":[";"],"id":665}],[{"start":{"row":99,"column":2},"end":{"row":99,"column":3},"action":"insert","lines":["i"],"id":666}],[{"start":{"row":99,"column":3},"end":{"row":99,"column":4},"action":"insert","lines":["f"],"id":667}],[{"start":{"row":99,"column":4},"end":{"row":99,"column":5},"action":"insert","lines":["("],"id":668}],[{"start":{"row":99,"column":43},"end":{"row":99,"column":44},"action":"insert","lines":[")"],"id":669}],[{"start":{"row":99,"column":44},"end":{"row":99,"column":45},"action":"remove","lines":[";"],"id":670}],[{"start":{"row":99,"column":44},"end":{"row":99,"column":45},"action":"insert","lines":["{"],"id":671}],[{"start":{"row":99,"column":45},"end":{"row":99,"column":46},"action":"insert","lines":["}"],"id":672}],[{"start":{"row":99,"column":45},"end":{"row":101,"column":2},"action":"insert","lines":["","    ","  "],"id":673}],[{"start":{"row":100,"column":4},"end":{"row":100,"column":5},"action":"insert","lines":["e"],"id":674}],[{"start":{"row":100,"column":5},"end":{"row":100,"column":6},"action":"insert","lines":["c"],"id":675}],[{"start":{"row":100,"column":6},"end":{"row":100,"column":7},"action":"insert","lines":["h"],"id":676}],[{"start":{"row":100,"column":7},"end":{"row":100,"column":8},"action":"insert","lines":["o"],"id":677}],[{"start":{"row":100,"column":8},"end":{"row":100,"column":9},"action":"insert","lines":[" "],"id":678}],[{"start":{"row":100,"column":9},"end":{"row":100,"column":11},"action":"insert","lines":["\"\""],"id":679}],[{"start":{"row":100,"column":10},"end":{"row":100,"column":11},"action":"insert","lines":["f"],"id":680}],[{"start":{"row":100,"column":11},"end":{"row":100,"column":12},"action":"insert","lines":["i"],"id":681}],[{"start":{"row":100,"column":12},"end":{"row":100,"column":13},"action":"insert","lines":["l"],"id":682}],[{"start":{"row":100,"column":13},"end":{"row":100,"column":14},"action":"insert","lines":["e"],"id":683}],[{"start":{"row":100,"column":14},"end":{"row":100,"column":15},"action":"insert","lines":[" "],"id":684}],[{"start":{"row":100,"column":15},"end":{"row":100,"column":16},"action":"insert","lines":["c"],"id":685}],[{"start":{"row":100,"column":16},"end":{"row":100,"column":17},"action":"insert","lines":["l"],"id":686}],[{"start":{"row":100,"column":17},"end":{"row":100,"column":18},"action":"insert","lines":["e"],"id":687}],[{"start":{"row":100,"column":18},"end":{"row":100,"column":19},"action":"insert","lines":["a"],"id":688}],[{"start":{"row":100,"column":19},"end":{"row":100,"column":20},"action":"insert","lines":["n"],"id":689}],[{"start":{"row":100,"column":21},"end":{"row":100,"column":22},"action":"insert","lines":[";"],"id":690}],[{"start":{"row":101,"column":3},"end":{"row":101,"column":4},"action":"insert","lines":["e"],"id":691}],[{"start":{"row":101,"column":4},"end":{"row":101,"column":5},"action":"insert","lines":["s"],"id":692}],[{"start":{"row":101,"column":5},"end":{"row":101,"column":6},"action":"insert","lines":["l"],"id":693}],[{"start":{"row":101,"column":5},"end":{"row":101,"column":6},"action":"remove","lines":["l"],"id":694}],[{"start":{"row":101,"column":4},"end":{"row":101,"column":5},"action":"remove","lines":["s"],"id":695}],[{"start":{"row":101,"column":4},"end":{"row":101,"column":5},"action":"insert","lines":["l"],"id":696}],[{"start":{"row":101,"column":5},"end":{"row":101,"column":6},"action":"insert","lines":["s"],"id":697}],[{"start":{"row":101,"column":6},"end":{"row":101,"column":7},"action":"insert","lines":["e"],"id":698}],[{"start":{"row":101,"column":7},"end":{"row":101,"column":8},"action":"insert","lines":["{"],"id":699}],[{"start":{"row":101,"column":8},"end":{"row":101,"column":9},"action":"insert","lines":["}"],"id":700}],[{"start":{"row":101,"column":8},"end":{"row":103,"column":2},"action":"insert","lines":["","    ","  "],"id":701}],[{"start":{"row":102,"column":4},"end":{"row":102,"column":22},"action":"insert","lines":["echo \"file clean\";"],"id":702}],[{"start":{"row":102,"column":10},"end":{"row":102,"column":20},"action":"remove","lines":["file clean"],"id":703},{"start":{"row":102,"column":10},"end":{"row":102,"column":11},"action":"insert","lines":["d"]}],[{"start":{"row":102,"column":11},"end":{"row":102,"column":12},"action":"insert","lines":["a"],"id":704}],[{"start":{"row":102,"column":12},"end":{"row":102,"column":13},"action":"insert","lines":["n"],"id":705}],[{"start":{"row":102,"column":13},"end":{"row":102,"column":14},"action":"insert","lines":["g"],"id":706}],[{"start":{"row":102,"column":14},"end":{"row":102,"column":15},"action":"insert","lines":["e"],"id":707}],[{"start":{"row":102,"column":15},"end":{"row":102,"column":16},"action":"insert","lines":["r"],"id":708}],[{"start":{"row":83,"column":4},"end":{"row":83,"column":5},"action":"insert","lines":["/"],"id":709}],[{"start":{"row":83,"column":5},"end":{"row":83,"column":6},"action":"insert","lines":["/"],"id":710}],[{"start":{"row":27,"column":0},"end":{"row":27,"column":16},"action":"insert","lines":["echo \"The file \""],"id":711}],[{"start":{"row":27,"column":16},"end":{"row":27,"column":17},"action":"insert","lines":[";"],"id":712}],[{"start":{"row":27,"column":6},"end":{"row":27,"column":15},"action":"remove","lines":["The file "],"id":713},{"start":{"row":27,"column":6},"end":{"row":27,"column":7},"action":"insert","lines":["<"]}],[{"start":{"row":27,"column":7},"end":{"row":27,"column":8},"action":"insert","lines":[">"],"id":714}],[{"start":{"row":27,"column":7},"end":{"row":27,"column":8},"action":"insert","lines":["b"],"id":715}],[{"start":{"row":27,"column":8},"end":{"row":27,"column":9},"action":"insert","lines":["r"],"id":716}],[{"start":{"row":98,"column":4},"end":{"row":98,"column":5},"action":"remove","lines":["s"],"id":717}],[{"start":{"row":98,"column":3},"end":{"row":98,"column":4},"action":"remove","lines":["a"],"id":718}],[{"start":{"row":98,"column":3},"end":{"row":98,"column":4},"action":"insert","lines":["f"],"id":719}],[{"start":{"row":98,"column":4},"end":{"row":98,"column":5},"action":"insert","lines":["i"],"id":720}],[{"start":{"row":98,"column":5},"end":{"row":98,"column":6},"action":"insert","lines":["l"],"id":721}],[{"start":{"row":98,"column":6},"end":{"row":98,"column":7},"action":"insert","lines":["e"],"id":722}],[{"start":{"row":98,"column":7},"end":{"row":98,"column":8},"action":"insert","lines":["h"],"id":723}],[{"start":{"row":98,"column":8},"end":{"row":98,"column":9},"action":"insert","lines":["a"],"id":724}],[{"start":{"row":98,"column":9},"end":{"row":98,"column":10},"action":"insert","lines":["s"],"id":725}],[{"start":{"row":98,"column":10},"end":{"row":98,"column":11},"action":"insert","lines":["h"],"id":726}],[{"start":{"row":99,"column":39},"end":{"row":99,"column":42},"action":"remove","lines":["$as"],"id":727},{"start":{"row":99,"column":39},"end":{"row":99,"column":48},"action":"insert","lines":["$filehash"]}],[{"start":{"row":103,"column":3},"end":{"row":104,"column":0},"action":"insert","lines":["",""],"id":728},{"start":{"row":104,"column":0},"end":{"row":104,"column":2},"action":"insert","lines":["  "]}],[{"start":{"row":104,"column":2},"end":{"row":105,"column":0},"action":"insert","lines":["",""],"id":729},{"start":{"row":105,"column":0},"end":{"row":105,"column":2},"action":"insert","lines":["  "]}],[{"start":{"row":105,"column":2},"end":{"row":105,"column":11},"action":"insert","lines":["sha1_file"],"id":730}],[{"start":{"row":105,"column":11},"end":{"row":105,"column":13},"action":"insert","lines":["()"],"id":731}],[{"start":{"row":105,"column":13},"end":{"row":105,"column":14},"action":"insert","lines":[";"],"id":732}]]},"ace":{"folds":[],"scrolltop":1179.5,"scrollleft":0,"selection":{"start":{"row":105,"column":14},"end":{"row":105,"column":14},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":{"row":77,"state":"php-start","mode":"ace/mode/php"}},"timestamp":1522101413533}