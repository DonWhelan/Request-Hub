<?php
    
    // ref: https://codereview.stackexchange.com/questions/30500/secure-logout-session-termination
    
    session_start();

        unset($_SESSION["user"]);
        unset($_SESSION["ip"]);
        unset($_SESSION["browser"]);
        unset($_SESSION["cookieId"]);
        session_destroy();
        session_regenerate_id(true);

        
        $_SESSION = array();
        
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        
        session_destroy();
        
        header("Location: index.php");
        die();
    

?>