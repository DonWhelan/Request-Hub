{"filter":false,"title":"session.php","tooltip":"/controler/sessionManagment/session.php","undoManager":{"mark":2,"position":2,"stack":[[{"start":{"row":1,"column":10},"end":{"row":1,"column":26},"action":"remove","lines":["session_start();"],"id":5}],[{"start":{"row":4,"column":30},"end":{"row":4,"column":31},"action":"insert","lines":["."],"id":6},{"start":{"row":4,"column":31},"end":{"row":4,"column":32},"action":"insert","lines":["."]},{"start":{"row":4,"column":32},"end":{"row":4,"column":33},"action":"insert","lines":["/"]},{"start":{"row":4,"column":33},"end":{"row":4,"column":34},"action":"insert","lines":["."]},{"start":{"row":4,"column":34},"end":{"row":4,"column":35},"action":"insert","lines":["."]},{"start":{"row":4,"column":35},"end":{"row":4,"column":36},"action":"insert","lines":["/"]}],[{"start":{"row":7,"column":26},"end":{"row":7,"column":27},"action":"insert","lines":["."],"id":7},{"start":{"row":7,"column":27},"end":{"row":7,"column":28},"action":"insert","lines":["."]},{"start":{"row":7,"column":28},"end":{"row":7,"column":29},"action":"insert","lines":["/"]},{"start":{"row":7,"column":29},"end":{"row":7,"column":30},"action":"insert","lines":["."]},{"start":{"row":7,"column":30},"end":{"row":7,"column":31},"action":"insert","lines":["."]},{"start":{"row":7,"column":31},"end":{"row":7,"column":32},"action":"insert","lines":["/"]}],[{"start":{"row":2,"column":0},"end":{"row":8,"column":5},"action":"remove","lines":["    if($_SESSION['user'] != null){","        if($_SESSION['browser'] != $_SERVER['HTTP_USER_AGENT'] || $_SESSION['ip'] != get_client_ip_env() || $_COOKIE['cookieId'] != $_SESSION['cookieId']) {","            header(\"Location: ../../index.php\");","        }","    }else{","        header(\"Location: ../../index.php\");","    }"],"id":8}]]},"ace":{"folds":[],"customSyntax":"php","scrolltop":0,"scrollleft":0,"selection":{"start":{"row":2,"column":0},"end":{"row":8,"column":5},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":0},"timestamp":1523304425675,"hash":"bb98c1867a2186880637bf110c4aaf38a624afeb"}