    
    <?php 
    if($_SESSION['user'] != null){
        if($_SESSION['browser'] != $_SERVER['HTTP_USER_AGENT'] || $_SESSION['ip'] != get_client_ip_env() || $_COOKIE['cookieId'] != $_SESSION['cookieId']) {
            header("Location: ../../../index.php");
        }
    }else{
        header("Location: ../../../index.php");
    }
    ?>