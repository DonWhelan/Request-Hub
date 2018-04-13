{"filter":false,"title":"insertModel_teamEdit.php","tooltip":"/model/insertModel_teamEdit.php","undoManager":{"mark":1,"position":1,"stack":[[{"start":{"row":10,"column":4},"end":{"row":51,"column":5},"action":"remove","lines":["function select_prepared_teamEdit_transaction($dir,$company) {","","        include($dir.\"../pem/sqlSelect.php\");","        $connection = mysqli_connect(sHOST, sUSER, sPASS);","        if (!$connection) {","            trigger_error(\"Could not reach database!<br/>\");","            include(\"logs/logsMail-1dir.php\");","            exit();","        }","        $db_selected = mysqli_select_db($connection, sDB);","        if (!$db_selected) {","            trigger_error(\"Could not reach database!<br/>\");","            include(\"logs/logsMail-1dir.php\");","            exit();","        }","        /* check connection */","        if (mysqli_connect_errno($connection)) {","            printf(\"Connect failed: %s\\n\", mysqli_connect_error());","            exit();","        }","        ","        /*","         * We have created a view of the users table called userLogonView. It only has access to username and password colums,","         * if details of the query were exploited only u-name and p-word would be exposed and no other personal information.","         */","","        if ($stmt = mysqli_prepare($connection, \"SELECT uid, teamName, role FROM Teams WHERE owningCompany = ?\")) {","            mysqli_stmt_bind_param($stmt, \"s\", $company);","            mysqli_stmt_execute($stmt);","            $resultTeamName = \"\";","            $resultRole = \"\";","            $uid = \"\";","            mysqli_stmt_bind_result($stmt, $uid, $resultTeamName, $resultRole);   ","            while (mysqli_stmt_fetch($stmt)) {","                echo \"<li class='list-group-item'>","                      <b>\".$resultTeamName . \"</b>: \" . $resultRole.\"<a href='teamEditAmend.php?uid=\".$uid.\"'><button class='btn btn-outline-success btn-xs float-right' type='submit'>edit</button>\".","                      \"</a></li>\";","            }","            mysqli_stmt_close($stmt);","        }","       mysqli_close($connection);","    }"],"id":376},{"start":{"row":10,"column":0},"end":{"row":10,"column":4},"action":"remove","lines":["    "]},{"start":{"row":9,"column":5},"end":{"row":10,"column":0},"action":"remove","lines":["",""]},{"start":{"row":9,"column":4},"end":{"row":9,"column":5},"action":"remove","lines":[" "]},{"start":{"row":9,"column":0},"end":{"row":9,"column":4},"action":"remove","lines":["    "]},{"start":{"row":8,"column":5},"end":{"row":9,"column":0},"action":"remove","lines":["",""]},{"start":{"row":8,"column":4},"end":{"row":8,"column":5},"action":"remove","lines":[" "]}],[{"start":{"row":8,"column":0},"end":{"row":8,"column":4},"action":"remove","lines":["    "],"id":377},{"start":{"row":7,"column":9},"end":{"row":8,"column":0},"action":"remove","lines":["",""]}]]},"ace":{"folds":[],"scrolltop":337.5,"scrollleft":0,"selection":{"start":{"row":40,"column":7},"end":{"row":40,"column":7},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":{"row":23,"state":"php-start","mode":"ace/mode/php"}},"timestamp":1523623367848,"hash":"ba8c7801fa9b71b31f272ee839121b6e130eae5d"}