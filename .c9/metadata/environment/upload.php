{"filter":false,"title":"upload.php","tooltip":"/upload.php","undoManager":{"mark":100,"position":100,"stack":[[{"start":{"row":118,"column":68},"end":{"row":118,"column":77},"action":"insert","lines":["download/"],"id":19}],[{"start":{"row":18,"column":35},"end":{"row":18,"column":36},"action":"insert","lines":["."],"id":20}],[{"start":{"row":2,"column":0},"end":{"row":4,"column":5},"action":"remove","lines":["    if($_SESSION['browser'] != $_SERVER['HTTP_USER_AGENT'] && $_SESSION['ip'] != get_client_ip_env() && $_COOKIE['cookieId'] != $_SESSION['cookieId']) {","        header(\"Location: index.php\");","    }"],"id":21},{"start":{"row":2,"column":0},"end":{"row":4,"column":9},"action":"insert","lines":["        if($_SESSION['browser'] != $_SERVER['HTTP_USER_AGENT'] || $_SESSION['ip'] != get_client_ip_env() || $_COOKIE['cookieId'] != $_SESSION['cookieId']) {","            header(\"Location: index.php\");","        }"]}],[{"start":{"row":118,"column":102},"end":{"row":119,"column":0},"action":"insert","lines":["",""],"id":22},{"start":{"row":119,"column":0},"end":{"row":119,"column":24},"action":"insert","lines":["                        "]}],[{"start":{"row":2,"column":7},"end":{"row":4,"column":9},"action":"remove","lines":[" if($_SESSION['browser'] != $_SERVER['HTTP_USER_AGENT'] || $_SESSION['ip'] != get_client_ip_env() || $_COOKIE['cookieId'] != $_SESSION['cookieId']) {","            header(\"Location: index.php\");","        }"],"id":23},{"start":{"row":2,"column":7},"end":{"row":8,"column":5},"action":"insert","lines":["    if($_SESSION['user'] != null){","        if($_SESSION['browser'] != $_SERVER['HTTP_USER_AGENT'] || $_SESSION['ip'] != get_client_ip_env() || $_COOKIE['cookieId'] != $_SESSION['cookieId']) {","            header(\"Location: index.php\");","        }","    }else{","        header(\"Location: index.php\");","    }"]}],[{"start":{"row":2,"column":10},"end":{"row":2,"column":11},"action":"remove","lines":[" "],"id":24},{"start":{"row":2,"column":9},"end":{"row":2,"column":10},"action":"remove","lines":[" "]},{"start":{"row":2,"column":8},"end":{"row":2,"column":9},"action":"remove","lines":[" "]},{"start":{"row":2,"column":4},"end":{"row":2,"column":8},"action":"remove","lines":["    "]}],[{"start":{"row":3,"column":8},"end":{"row":3,"column":11},"action":"insert","lines":["// "],"id":25},{"start":{"row":4,"column":8},"end":{"row":4,"column":11},"action":"insert","lines":["// "]},{"start":{"row":5,"column":8},"end":{"row":5,"column":11},"action":"insert","lines":["// "]}],[{"start":{"row":1,"column":20},"end":{"row":2,"column":0},"action":"insert","lines":["",""],"id":26},{"start":{"row":2,"column":0},"end":{"row":2,"column":4},"action":"insert","lines":["    "]}],[{"start":{"row":2,"column":4},"end":{"row":2,"column":46},"action":"insert","lines":["include('includes/connectionStrings.php');"],"id":27}],[{"start":{"row":4,"column":8},"end":{"row":4,"column":11},"action":"remove","lines":["// "],"id":28},{"start":{"row":5,"column":8},"end":{"row":5,"column":11},"action":"remove","lines":["// "]},{"start":{"row":6,"column":8},"end":{"row":6,"column":11},"action":"remove","lines":["// "]}],[{"start":{"row":124,"column":24},"end":{"row":124,"column":72},"action":"insert","lines":["if($debug){echo \"danger danger Will Robinson!\";}"],"id":43}],[{"start":{"row":124,"column":41},"end":{"row":124,"column":69},"action":"remove","lines":["danger danger Will Robinson!"],"id":44},{"start":{"row":124,"column":41},"end":{"row":124,"column":42},"action":"insert","lines":["f"]},{"start":{"row":124,"column":42},"end":{"row":124,"column":43},"action":"insert","lines":["i"]},{"start":{"row":124,"column":43},"end":{"row":124,"column":44},"action":"insert","lines":["l"]},{"start":{"row":124,"column":44},"end":{"row":124,"column":45},"action":"insert","lines":["e"]}],[{"start":{"row":124,"column":45},"end":{"row":124,"column":46},"action":"insert","lines":[" "],"id":45},{"start":{"row":124,"column":46},"end":{"row":124,"column":47},"action":"insert","lines":["c"]},{"start":{"row":124,"column":47},"end":{"row":124,"column":48},"action":"insert","lines":["o"]},{"start":{"row":124,"column":48},"end":{"row":124,"column":49},"action":"insert","lines":["p"]},{"start":{"row":124,"column":49},"end":{"row":124,"column":50},"action":"insert","lines":["i"]},{"start":{"row":124,"column":50},"end":{"row":124,"column":51},"action":"insert","lines":["e"]},{"start":{"row":124,"column":51},"end":{"row":124,"column":52},"action":"insert","lines":["d"]}],[{"start":{"row":124,"column":52},"end":{"row":124,"column":53},"action":"insert","lines":["<"],"id":46},{"start":{"row":124,"column":53},"end":{"row":124,"column":54},"action":"insert","lines":[">"]}],[{"start":{"row":124,"column":53},"end":{"row":124,"column":54},"action":"insert","lines":["b"],"id":47},{"start":{"row":124,"column":54},"end":{"row":124,"column":55},"action":"insert","lines":["r"]}],[{"start":{"row":127,"column":23},"end":{"row":127,"column":24},"action":"insert","lines":["/"],"id":48},{"start":{"row":127,"column":24},"end":{"row":127,"column":25},"action":"insert","lines":["/"]}],[{"start":{"row":127,"column":24},"end":{"row":127,"column":25},"action":"remove","lines":["/"],"id":49},{"start":{"row":127,"column":23},"end":{"row":127,"column":24},"action":"remove","lines":["/"]}],[{"start":{"row":123,"column":102},"end":{"row":124,"column":0},"action":"insert","lines":["",""],"id":50},{"start":{"row":124,"column":0},"end":{"row":124,"column":24},"action":"insert","lines":["                        "]}],[{"start":{"row":124,"column":24},"end":{"row":124,"column":25},"action":"insert","lines":["f"],"id":51},{"start":{"row":124,"column":25},"end":{"row":124,"column":26},"action":"insert","lines":["i"]},{"start":{"row":124,"column":26},"end":{"row":124,"column":27},"action":"insert","lines":["l"]}],[{"start":{"row":124,"column":27},"end":{"row":124,"column":28},"action":"insert","lines":["e"],"id":52},{"start":{"row":124,"column":28},"end":{"row":124,"column":29},"action":"insert","lines":["_"]}],[{"start":{"row":124,"column":29},"end":{"row":124,"column":30},"action":"insert","lines":["g"],"id":53},{"start":{"row":124,"column":30},"end":{"row":124,"column":31},"action":"insert","lines":["e"]},{"start":{"row":124,"column":31},"end":{"row":124,"column":32},"action":"insert","lines":["t"]},{"start":{"row":124,"column":32},"end":{"row":124,"column":33},"action":"insert","lines":["_"]}],[{"start":{"row":124,"column":33},"end":{"row":124,"column":34},"action":"insert","lines":["c"],"id":54},{"start":{"row":124,"column":34},"end":{"row":124,"column":35},"action":"insert","lines":["o"]},{"start":{"row":124,"column":35},"end":{"row":124,"column":36},"action":"insert","lines":["n"]},{"start":{"row":124,"column":36},"end":{"row":124,"column":37},"action":"insert","lines":["r"]}],[{"start":{"row":124,"column":36},"end":{"row":124,"column":37},"action":"remove","lines":["r"],"id":55}],[{"start":{"row":124,"column":36},"end":{"row":124,"column":37},"action":"insert","lines":["t"],"id":56},{"start":{"row":124,"column":37},"end":{"row":124,"column":38},"action":"insert","lines":["e"]},{"start":{"row":124,"column":38},"end":{"row":124,"column":39},"action":"insert","lines":["n"]},{"start":{"row":124,"column":39},"end":{"row":124,"column":40},"action":"insert","lines":["t"]},{"start":{"row":124,"column":40},"end":{"row":124,"column":41},"action":"insert","lines":["s"]}],[{"start":{"row":124,"column":41},"end":{"row":124,"column":43},"action":"insert","lines":["()"],"id":57}],[{"start":{"row":122,"column":64},"end":{"row":123,"column":0},"action":"insert","lines":["",""],"id":58},{"start":{"row":123,"column":0},"end":{"row":123,"column":24},"action":"insert","lines":["                        "]}],[{"start":{"row":123,"column":24},"end":{"row":123,"column":25},"action":"insert","lines":["$"],"id":59}],[{"start":{"row":123,"column":25},"end":{"row":123,"column":26},"action":"insert","lines":["f"],"id":60},{"start":{"row":123,"column":26},"end":{"row":123,"column":27},"action":"insert","lines":["i"]},{"start":{"row":123,"column":27},"end":{"row":123,"column":28},"action":"insert","lines":["l"]},{"start":{"row":123,"column":28},"end":{"row":123,"column":29},"action":"insert","lines":["e"]},{"start":{"row":123,"column":29},"end":{"row":123,"column":30},"action":"insert","lines":["O"]}],[{"start":{"row":123,"column":30},"end":{"row":123,"column":31},"action":"insert","lines":["u"],"id":61},{"start":{"row":123,"column":31},"end":{"row":123,"column":32},"action":"insert","lines":["t"]},{"start":{"row":123,"column":32},"end":{"row":123,"column":33},"action":"insert","lines":["O"]},{"start":{"row":123,"column":33},"end":{"row":123,"column":34},"action":"insert","lines":["f"]},{"start":{"row":123,"column":34},"end":{"row":123,"column":35},"action":"insert","lines":["W"]}],[{"start":{"row":123,"column":35},"end":{"row":123,"column":36},"action":"insert","lines":["e"],"id":62},{"start":{"row":123,"column":36},"end":{"row":123,"column":37},"action":"insert","lines":["b"]}],[{"start":{"row":123,"column":37},"end":{"row":123,"column":38},"action":"insert","lines":["R"],"id":63},{"start":{"row":123,"column":38},"end":{"row":123,"column":39},"action":"insert","lines":["o"]},{"start":{"row":123,"column":39},"end":{"row":123,"column":40},"action":"insert","lines":["o"]},{"start":{"row":123,"column":40},"end":{"row":123,"column":41},"action":"insert","lines":["t"]}],[{"start":{"row":123,"column":41},"end":{"row":123,"column":42},"action":"insert","lines":[" "],"id":64},{"start":{"row":123,"column":42},"end":{"row":123,"column":43},"action":"insert","lines":["="]}],[{"start":{"row":123,"column":43},"end":{"row":123,"column":44},"action":"insert","lines":[" "],"id":65}],[{"start":{"row":123,"column":44},"end":{"row":123,"column":87},"action":"insert","lines":["\"../images/download/\".$newFileName.\".\".$ext"],"id":66}],[{"start":{"row":123,"column":87},"end":{"row":123,"column":88},"action":"insert","lines":[";"],"id":67}],[{"start":{"row":124,"column":57},"end":{"row":124,"column":100},"action":"remove","lines":["\"../images/download/\".$newFileName.\".\".$ext"],"id":68},{"start":{"row":124,"column":57},"end":{"row":124,"column":74},"action":"insert","lines":["$fileOutOfWebRoot"]}],[{"start":{"row":125,"column":24},"end":{"row":125,"column":25},"action":"insert","lines":["/"],"id":69},{"start":{"row":125,"column":25},"end":{"row":125,"column":26},"action":"insert","lines":["/"]}],[{"start":{"row":125,"column":45},"end":{"row":126,"column":0},"action":"insert","lines":["",""],"id":70},{"start":{"row":126,"column":0},"end":{"row":126,"column":24},"action":"insert","lines":["                        "]},{"start":{"row":126,"column":24},"end":{"row":127,"column":0},"action":"insert","lines":["",""]},{"start":{"row":127,"column":0},"end":{"row":127,"column":24},"action":"insert","lines":["                        "]},{"start":{"row":127,"column":24},"end":{"row":128,"column":0},"action":"insert","lines":["",""]},{"start":{"row":128,"column":0},"end":{"row":128,"column":24},"action":"insert","lines":["                        "]},{"start":{"row":128,"column":24},"end":{"row":129,"column":0},"action":"insert","lines":["",""]},{"start":{"row":129,"column":0},"end":{"row":129,"column":24},"action":"insert","lines":["                        "]}],[{"start":{"row":127,"column":24},"end":{"row":140,"column":64},"action":"insert","lines":["$originalContents = file_get_contents(\"hello.png\");","echo \"<br>originalContents \".md5($originalContents).\"<br>\";","","$encryptedContents = encrypt($key,$originalContents);","file_put_contents(\"ecrpt.png\",$encryptedContents);","$encryptedContents = file_get_contents(\"ecrpt.png\");","echo \"<br>encryptedContents \".md5($originalContents).\"<br>\";","","$encryptedContents = decrypt($key,$encryptedContents);","unlink(\"hello.png\");","file_put_contents(\"hello.png\",$encryptedContents);","$originalContents = file_get_contents(\"hello.png\");","","echo \"<br>new decryptedContents \".md5($originalContents).\"<br>\";"],"id":71}],[{"start":{"row":128,"column":0},"end":{"row":128,"column":4},"action":"insert","lines":["    "],"id":72},{"start":{"row":129,"column":0},"end":{"row":129,"column":4},"action":"insert","lines":["    "]},{"start":{"row":130,"column":0},"end":{"row":130,"column":4},"action":"insert","lines":["    "]},{"start":{"row":131,"column":0},"end":{"row":131,"column":4},"action":"insert","lines":["    "]},{"start":{"row":132,"column":0},"end":{"row":132,"column":4},"action":"insert","lines":["    "]},{"start":{"row":133,"column":0},"end":{"row":133,"column":4},"action":"insert","lines":["    "]},{"start":{"row":134,"column":0},"end":{"row":134,"column":4},"action":"insert","lines":["    "]},{"start":{"row":135,"column":0},"end":{"row":135,"column":4},"action":"insert","lines":["    "]},{"start":{"row":136,"column":0},"end":{"row":136,"column":4},"action":"insert","lines":["    "]},{"start":{"row":137,"column":0},"end":{"row":137,"column":4},"action":"insert","lines":["    "]},{"start":{"row":138,"column":0},"end":{"row":138,"column":4},"action":"insert","lines":["    "]},{"start":{"row":139,"column":0},"end":{"row":139,"column":4},"action":"insert","lines":["    "]},{"start":{"row":140,"column":0},"end":{"row":140,"column":4},"action":"insert","lines":["    "]}],[{"start":{"row":128,"column":0},"end":{"row":128,"column":4},"action":"insert","lines":["    "],"id":73},{"start":{"row":129,"column":0},"end":{"row":129,"column":4},"action":"insert","lines":["    "]},{"start":{"row":130,"column":0},"end":{"row":130,"column":4},"action":"insert","lines":["    "]},{"start":{"row":131,"column":0},"end":{"row":131,"column":4},"action":"insert","lines":["    "]},{"start":{"row":132,"column":0},"end":{"row":132,"column":4},"action":"insert","lines":["    "]},{"start":{"row":133,"column":0},"end":{"row":133,"column":4},"action":"insert","lines":["    "]},{"start":{"row":134,"column":0},"end":{"row":134,"column":4},"action":"insert","lines":["    "]},{"start":{"row":135,"column":0},"end":{"row":135,"column":4},"action":"insert","lines":["    "]},{"start":{"row":136,"column":0},"end":{"row":136,"column":4},"action":"insert","lines":["    "]},{"start":{"row":137,"column":0},"end":{"row":137,"column":4},"action":"insert","lines":["    "]},{"start":{"row":138,"column":0},"end":{"row":138,"column":4},"action":"insert","lines":["    "]},{"start":{"row":139,"column":0},"end":{"row":139,"column":4},"action":"insert","lines":["    "]},{"start":{"row":140,"column":0},"end":{"row":140,"column":4},"action":"insert","lines":["    "]}],[{"start":{"row":128,"column":0},"end":{"row":128,"column":4},"action":"insert","lines":["    "],"id":74},{"start":{"row":129,"column":0},"end":{"row":129,"column":4},"action":"insert","lines":["    "]},{"start":{"row":130,"column":0},"end":{"row":130,"column":4},"action":"insert","lines":["    "]},{"start":{"row":131,"column":0},"end":{"row":131,"column":4},"action":"insert","lines":["    "]},{"start":{"row":132,"column":0},"end":{"row":132,"column":4},"action":"insert","lines":["    "]},{"start":{"row":133,"column":0},"end":{"row":133,"column":4},"action":"insert","lines":["    "]},{"start":{"row":134,"column":0},"end":{"row":134,"column":4},"action":"insert","lines":["    "]},{"start":{"row":135,"column":0},"end":{"row":135,"column":4},"action":"insert","lines":["    "]},{"start":{"row":136,"column":0},"end":{"row":136,"column":4},"action":"insert","lines":["    "]},{"start":{"row":137,"column":0},"end":{"row":137,"column":4},"action":"insert","lines":["    "]},{"start":{"row":138,"column":0},"end":{"row":138,"column":4},"action":"insert","lines":["    "]},{"start":{"row":139,"column":0},"end":{"row":139,"column":4},"action":"insert","lines":["    "]},{"start":{"row":140,"column":0},"end":{"row":140,"column":4},"action":"insert","lines":["    "]}],[{"start":{"row":128,"column":0},"end":{"row":128,"column":4},"action":"insert","lines":["    "],"id":75},{"start":{"row":129,"column":0},"end":{"row":129,"column":4},"action":"insert","lines":["    "]},{"start":{"row":130,"column":0},"end":{"row":130,"column":4},"action":"insert","lines":["    "]},{"start":{"row":131,"column":0},"end":{"row":131,"column":4},"action":"insert","lines":["    "]},{"start":{"row":132,"column":0},"end":{"row":132,"column":4},"action":"insert","lines":["    "]},{"start":{"row":133,"column":0},"end":{"row":133,"column":4},"action":"insert","lines":["    "]},{"start":{"row":134,"column":0},"end":{"row":134,"column":4},"action":"insert","lines":["    "]},{"start":{"row":135,"column":0},"end":{"row":135,"column":4},"action":"insert","lines":["    "]},{"start":{"row":136,"column":0},"end":{"row":136,"column":4},"action":"insert","lines":["    "]},{"start":{"row":137,"column":0},"end":{"row":137,"column":4},"action":"insert","lines":["    "]},{"start":{"row":138,"column":0},"end":{"row":138,"column":4},"action":"insert","lines":["    "]},{"start":{"row":139,"column":0},"end":{"row":139,"column":4},"action":"insert","lines":["    "]},{"start":{"row":140,"column":0},"end":{"row":140,"column":4},"action":"insert","lines":["    "]}],[{"start":{"row":128,"column":0},"end":{"row":128,"column":4},"action":"insert","lines":["    "],"id":76},{"start":{"row":129,"column":0},"end":{"row":129,"column":4},"action":"insert","lines":["    "]},{"start":{"row":130,"column":0},"end":{"row":130,"column":4},"action":"insert","lines":["    "]},{"start":{"row":131,"column":0},"end":{"row":131,"column":4},"action":"insert","lines":["    "]},{"start":{"row":132,"column":0},"end":{"row":132,"column":4},"action":"insert","lines":["    "]},{"start":{"row":133,"column":0},"end":{"row":133,"column":4},"action":"insert","lines":["    "]},{"start":{"row":134,"column":0},"end":{"row":134,"column":4},"action":"insert","lines":["    "]},{"start":{"row":135,"column":0},"end":{"row":135,"column":4},"action":"insert","lines":["    "]},{"start":{"row":136,"column":0},"end":{"row":136,"column":4},"action":"insert","lines":["    "]},{"start":{"row":137,"column":0},"end":{"row":137,"column":4},"action":"insert","lines":["    "]},{"start":{"row":138,"column":0},"end":{"row":138,"column":4},"action":"insert","lines":["    "]},{"start":{"row":139,"column":0},"end":{"row":139,"column":4},"action":"insert","lines":["    "]},{"start":{"row":140,"column":0},"end":{"row":140,"column":4},"action":"insert","lines":["    "]}],[{"start":{"row":128,"column":0},"end":{"row":128,"column":4},"action":"insert","lines":["    "],"id":77},{"start":{"row":129,"column":0},"end":{"row":129,"column":4},"action":"insert","lines":["    "]},{"start":{"row":130,"column":0},"end":{"row":130,"column":4},"action":"insert","lines":["    "]},{"start":{"row":131,"column":0},"end":{"row":131,"column":4},"action":"insert","lines":["    "]},{"start":{"row":132,"column":0},"end":{"row":132,"column":4},"action":"insert","lines":["    "]},{"start":{"row":133,"column":0},"end":{"row":133,"column":4},"action":"insert","lines":["    "]},{"start":{"row":134,"column":0},"end":{"row":134,"column":4},"action":"insert","lines":["    "]},{"start":{"row":135,"column":0},"end":{"row":135,"column":4},"action":"insert","lines":["    "]},{"start":{"row":136,"column":0},"end":{"row":136,"column":4},"action":"insert","lines":["    "]},{"start":{"row":137,"column":0},"end":{"row":137,"column":4},"action":"insert","lines":["    "]},{"start":{"row":138,"column":0},"end":{"row":138,"column":4},"action":"insert","lines":["    "]},{"start":{"row":139,"column":0},"end":{"row":139,"column":4},"action":"insert","lines":["    "]},{"start":{"row":140,"column":0},"end":{"row":140,"column":4},"action":"insert","lines":["    "]}],[{"start":{"row":35,"column":42},"end":{"row":36,"column":0},"action":"insert","lines":["",""],"id":78},{"start":{"row":36,"column":0},"end":{"row":36,"column":4},"action":"insert","lines":["    "]}],[{"start":{"row":36,"column":4},"end":{"row":36,"column":42},"action":"insert","lines":["include('includes/Steganography.php');"],"id":79}],[{"start":{"row":36,"column":22},"end":{"row":36,"column":35},"action":"remove","lines":["Steganography"],"id":80},{"start":{"row":36,"column":22},"end":{"row":36,"column":23},"action":"insert","lines":["m"]},{"start":{"row":36,"column":23},"end":{"row":36,"column":24},"action":"insert","lines":["c"]},{"start":{"row":36,"column":24},"end":{"row":36,"column":25},"action":"insert","lines":["r"]}],[{"start":{"row":36,"column":25},"end":{"row":36,"column":26},"action":"insert","lines":["y"],"id":81},{"start":{"row":36,"column":26},"end":{"row":36,"column":27},"action":"insert","lines":["p"]},{"start":{"row":36,"column":27},"end":{"row":36,"column":28},"action":"insert","lines":["t"]}],[{"start":{"row":36,"column":28},"end":{"row":36,"column":29},"action":"insert","lines":["."],"id":82},{"start":{"row":36,"column":29},"end":{"row":36,"column":30},"action":"insert","lines":["p"]},{"start":{"row":36,"column":30},"end":{"row":36,"column":31},"action":"insert","lines":["h"]},{"start":{"row":36,"column":31},"end":{"row":36,"column":32},"action":"insert","lines":["p"]}],[{"start":{"row":128,"column":62},"end":{"row":128,"column":73},"action":"remove","lines":["\"hello.png\""],"id":83},{"start":{"row":128,"column":62},"end":{"row":128,"column":79},"action":"insert","lines":["$fileOutOfWebRoot"]}],[{"start":{"row":129,"column":0},"end":{"row":129,"column":83},"action":"remove","lines":["                        echo \"<br>originalContents \".md5($originalContents).\"<br>\";"],"id":84}],[{"start":{"row":128,"column":81},"end":{"row":129,"column":0},"action":"remove","lines":["",""],"id":85}],[{"start":{"row":129,"column":1},"end":{"row":129,"column":2},"action":"remove","lines":[" "],"id":86},{"start":{"row":129,"column":0},"end":{"row":129,"column":1},"action":"remove","lines":[" "]},{"start":{"row":128,"column":81},"end":{"row":129,"column":22},"action":"remove","lines":["","                      "]}],[{"start":{"row":130,"column":42},"end":{"row":130,"column":53},"action":"remove","lines":["\"ecrpt.png\""],"id":87},{"start":{"row":130,"column":42},"end":{"row":130,"column":59},"action":"insert","lines":["$fileOutOfWebRoot"]}],[{"start":{"row":131,"column":24},"end":{"row":134,"column":78},"action":"remove","lines":["$encryptedContents = file_get_contents(\"ecrpt.png\");","                        echo \"<br>encryptedContents \".md5($originalContents).\"<br>\";","                        ","                        $encryptedContents = decrypt($key,$encryptedContents);"],"id":88}],[{"start":{"row":36,"column":35},"end":{"row":36,"column":36},"action":"remove","lines":["p"],"id":89},{"start":{"row":36,"column":34},"end":{"row":36,"column":35},"action":"remove","lines":["h"]},{"start":{"row":36,"column":33},"end":{"row":36,"column":34},"action":"remove","lines":["p"]},{"start":{"row":36,"column":32},"end":{"row":36,"column":33},"action":"remove","lines":["."]}],[{"start":{"row":133,"column":24},"end":{"row":136,"column":88},"action":"remove","lines":["file_put_contents(\"hello.png\",$encryptedContents);","                        $originalContents = file_get_contents(\"hello.png\");","                        ","                        echo \"<br>new decryptedContents \".md5($originalContents).\"<br>\";"],"id":90}],[{"start":{"row":132,"column":22},"end":{"row":132,"column":44},"action":"remove","lines":["  unlink(\"hello.png\");"],"id":91}],[{"start":{"row":129,"column":45},"end":{"row":129,"column":46},"action":"remove","lines":["e"],"id":92}],[{"start":{"row":129,"column":45},"end":{"row":129,"column":46},"action":"insert","lines":["m"],"id":93},{"start":{"row":129,"column":46},"end":{"row":129,"column":47},"action":"insert","lines":["c"]},{"start":{"row":129,"column":47},"end":{"row":129,"column":48},"action":"insert","lines":["r"]},{"start":{"row":129,"column":48},"end":{"row":129,"column":49},"action":"insert","lines":["y"]},{"start":{"row":129,"column":49},"end":{"row":129,"column":50},"action":"insert","lines":["p"]},{"start":{"row":129,"column":50},"end":{"row":129,"column":51},"action":"insert","lines":["t"]}],[{"start":{"row":129,"column":51},"end":{"row":129,"column":52},"action":"insert","lines":["E"],"id":94}],[{"start":{"row":126,"column":0},"end":{"row":126,"column":45},"action":"remove","lines":["                        //file_get_contents()"],"id":95}],[{"start":{"row":127,"column":0},"end":{"row":127,"column":24},"action":"remove","lines":["                        "],"id":96},{"start":{"row":126,"column":0},"end":{"row":127,"column":0},"action":"remove","lines":["",""]}],[{"start":{"row":126,"column":0},"end":{"row":126,"column":4},"action":"insert","lines":["    "],"id":97}],[{"start":{"row":126,"column":4},"end":{"row":126,"column":8},"action":"insert","lines":["    "],"id":98}],[{"start":{"row":126,"column":8},"end":{"row":126,"column":12},"action":"insert","lines":["    "],"id":99}],[{"start":{"row":126,"column":12},"end":{"row":126,"column":16},"action":"insert","lines":["    "],"id":100}],[{"start":{"row":126,"column":16},"end":{"row":126,"column":20},"action":"insert","lines":["    "],"id":101}],[{"start":{"row":126,"column":20},"end":{"row":126,"column":24},"action":"insert","lines":["    "],"id":102}],[{"start":{"row":126,"column":24},"end":{"row":126,"column":28},"action":"insert","lines":["    "],"id":103}],[{"start":{"row":126,"column":24},"end":{"row":126,"column":28},"action":"remove","lines":["    "],"id":104}],[{"start":{"row":126,"column":24},"end":{"row":126,"column":25},"action":"insert","lines":["/"],"id":105},{"start":{"row":126,"column":25},"end":{"row":126,"column":26},"action":"insert","lines":["/"]}],[{"start":{"row":126,"column":26},"end":{"row":126,"column":27},"action":"insert","lines":[" "],"id":106},{"start":{"row":126,"column":27},"end":{"row":126,"column":28},"action":"insert","lines":["1"]},{"start":{"row":126,"column":28},"end":{"row":126,"column":29},"action":"insert","lines":["2"]}],[{"start":{"row":126,"column":29},"end":{"row":126,"column":30},"action":"insert","lines":[" "],"id":107},{"start":{"row":126,"column":30},"end":{"row":126,"column":31},"action":"insert","lines":["-"]}],[{"start":{"row":126,"column":31},"end":{"row":126,"column":32},"action":"insert","lines":[" "],"id":108},{"start":{"row":126,"column":32},"end":{"row":126,"column":33},"action":"insert","lines":["E"]},{"start":{"row":126,"column":33},"end":{"row":126,"column":34},"action":"insert","lines":["n"]},{"start":{"row":126,"column":34},"end":{"row":126,"column":35},"action":"insert","lines":["c"]},{"start":{"row":126,"column":35},"end":{"row":126,"column":36},"action":"insert","lines":["r"]}],[{"start":{"row":126,"column":36},"end":{"row":126,"column":37},"action":"insert","lines":["y"],"id":109},{"start":{"row":126,"column":37},"end":{"row":126,"column":38},"action":"insert","lines":["t"]}],[{"start":{"row":126,"column":37},"end":{"row":126,"column":38},"action":"remove","lines":["t"],"id":110},{"start":{"row":126,"column":36},"end":{"row":126,"column":37},"action":"remove","lines":["y"]}],[{"start":{"row":126,"column":36},"end":{"row":126,"column":37},"action":"insert","lines":["y"],"id":111},{"start":{"row":126,"column":37},"end":{"row":126,"column":38},"action":"insert","lines":["p"]},{"start":{"row":126,"column":38},"end":{"row":126,"column":39},"action":"insert","lines":["t"]},{"start":{"row":126,"column":39},"end":{"row":126,"column":40},"action":"insert","lines":["s"]}],[{"start":{"row":126,"column":40},"end":{"row":126,"column":41},"action":"insert","lines":[" "],"id":112},{"start":{"row":126,"column":41},"end":{"row":126,"column":42},"action":"insert","lines":["c"]},{"start":{"row":126,"column":42},"end":{"row":126,"column":43},"action":"insert","lines":["o"]},{"start":{"row":126,"column":43},"end":{"row":126,"column":44},"action":"insert","lines":["n"]},{"start":{"row":126,"column":44},"end":{"row":126,"column":45},"action":"insert","lines":["t"]},{"start":{"row":126,"column":45},"end":{"row":126,"column":46},"action":"insert","lines":["e"]},{"start":{"row":126,"column":46},"end":{"row":126,"column":47},"action":"insert","lines":["n"]}],[{"start":{"row":126,"column":47},"end":{"row":126,"column":48},"action":"insert","lines":["t"],"id":113},{"start":{"row":126,"column":48},"end":{"row":126,"column":49},"action":"insert","lines":["s"]}],[{"start":{"row":126,"column":49},"end":{"row":126,"column":50},"action":"insert","lines":[" "],"id":114},{"start":{"row":126,"column":50},"end":{"row":126,"column":51},"action":"insert","lines":["o"]},{"start":{"row":126,"column":51},"end":{"row":126,"column":52},"action":"insert","lines":["f"]}],[{"start":{"row":126,"column":52},"end":{"row":126,"column":53},"action":"insert","lines":[" "],"id":115},{"start":{"row":126,"column":53},"end":{"row":126,"column":54},"action":"insert","lines":["f"]},{"start":{"row":126,"column":54},"end":{"row":126,"column":55},"action":"insert","lines":["i"]},{"start":{"row":126,"column":55},"end":{"row":126,"column":56},"action":"insert","lines":["l"]},{"start":{"row":126,"column":56},"end":{"row":126,"column":57},"action":"insert","lines":["e"]}],[{"start":{"row":130,"column":0},"end":{"row":134,"column":24},"action":"remove","lines":["                        ","                      ","                        ","                        ","                        "],"id":116}],[{"start":{"row":130,"column":0},"end":{"row":131,"column":59},"action":"remove","lines":["","                        if($debug){echo \"file copied<br>\";}"],"id":117},{"start":{"row":129,"column":80},"end":{"row":130,"column":0},"action":"remove","lines":["",""]}],[{"start":{"row":24,"column":57},"end":{"row":24,"column":58},"action":"insert","lines":[" "],"id":118},{"start":{"row":24,"column":58},"end":{"row":24,"column":59},"action":"insert","lines":["a"]},{"start":{"row":24,"column":59},"end":{"row":24,"column":60},"action":"insert","lines":["n"]},{"start":{"row":24,"column":60},"end":{"row":24,"column":61},"action":"insert","lines":["d"]}],[{"start":{"row":24,"column":61},"end":{"row":24,"column":62},"action":"insert","lines":[" "],"id":119}],[{"start":{"row":24,"column":62},"end":{"row":24,"column":87},"action":"insert","lines":["Encrypts contents of file"],"id":120}],[{"start":{"row":131,"column":28},"end":{"row":131,"column":29},"action":"remove","lines":["2"],"id":121}],[{"start":{"row":131,"column":28},"end":{"row":131,"column":29},"action":"insert","lines":["3"],"id":122}],[{"start":{"row":133,"column":28},"end":{"row":133,"column":29},"action":"remove","lines":["3"],"id":123}],[{"start":{"row":133,"column":28},"end":{"row":133,"column":29},"action":"insert","lines":["4"],"id":124}],[{"start":{"row":134,"column":28},"end":{"row":134,"column":29},"action":"remove","lines":["4"],"id":125}],[{"start":{"row":134,"column":28},"end":{"row":134,"column":29},"action":"insert","lines":["5"],"id":126}],[{"start":{"row":109,"column":106},"end":{"row":110,"column":0},"action":"insert","lines":["",""],"id":127},{"start":{"row":110,"column":0},"end":{"row":110,"column":28},"action":"insert","lines":["                            "]}],[{"start":{"row":110,"column":28},"end":{"row":113,"column":80},"action":"insert","lines":["// 12 - Encrypts contents of file","                        $originalContents = file_get_contents($fileOutOfWebRoot);","                        $encryptedContents = mcryptEncrypt($key,$originalContents);","                        file_put_contents($fileOutOfWebRoot,$encryptedContents);"],"id":128}],[{"start":{"row":111,"column":0},"end":{"row":111,"column":4},"action":"insert","lines":["    "],"id":129},{"start":{"row":112,"column":0},"end":{"row":112,"column":4},"action":"insert","lines":["    "]},{"start":{"row":113,"column":0},"end":{"row":113,"column":4},"action":"insert","lines":["    "]}],[{"start":{"row":109,"column":28},"end":{"row":109,"column":106},"action":"remove","lines":["copy(\"images/\".$OriginalFileName,\"../images/download/\".$newFileName.\".\".$ext);"],"id":130},{"start":{"row":109,"column":28},"end":{"row":110,"column":76},"action":"insert","lines":["$fileOutOfWebRoot = \"../images/download/\".$newFileName.\".\".$ext;","                        copy(\"images/\".$OriginalFileName,$fileOutOfWebRoot);"]}],[{"start":{"row":110,"column":24},"end":{"row":110,"column":28},"action":"insert","lines":["    "],"id":131}],[{"start":{"row":116,"column":32},"end":{"row":116,"column":33},"action":"remove","lines":["2"],"id":132}],[{"start":{"row":116,"column":32},"end":{"row":116,"column":33},"action":"insert","lines":["3"],"id":133}]]},"ace":{"folds":[],"scrolltop":1279,"scrollleft":0,"selection":{"start":{"row":112,"column":28},"end":{"row":114,"column":84},"isBackwards":true},"options":{"tabSize":4,"useSoftTabs":true,"guessTabSize":false,"useWrapMode":false,"wrapToView":true},"firstLineState":0},"timestamp":1522875899178,"hash":"0a1afdcacf51919f804e95f8e0af9dcdd1f864dd"}