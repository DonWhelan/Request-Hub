
<?php
    session_start();
    include('includes/connectionStrings.php');
    if($_SESSION['user'] != null){
        if($_SESSION['browser'] != $_SERVER['HTTP_USER_AGENT'] && $_SESSION['ip'] != get_client_ip_env() && $_COOKIE['cookieId'] != $_SESSION['cookieId']) {
            header("Location: index.php");
        }
    }else{
        header("Location: index.php");
    }    
?>
<html>
<head>
  <title>Upload your files</title>
</head>
<body>
    <br>
    upload photo
    <form enctype="multipart/form-data" action="uploads/upload.php" method="POST">
        <input type="file" name="uploaded_file"></input><br />
        <input type="submit" value="Upload"></input>
    </form>
    <hr>
    <br>
    view all photos
    <?php 
    echo '<pre>';
    var_dump($_SESSION);
    echo '</pre>';  
    ?>
    
    
</body>
</html>