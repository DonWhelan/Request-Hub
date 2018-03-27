
<?php
    session_start();
    include('connectionStrings.php');

    if($_SESSION['browser'] == $_SERVER['HTTP_USER_AGENT'] && $_SESSION['ip'] == get_client_ip_env() && $_COOKIE['cookieId'] == $_SESSION['cookieId']) {
        echo "welcome";
    }else{
        header("Location: index.php");
    }   
?>
