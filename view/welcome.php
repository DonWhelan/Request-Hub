
<?php
    include('../model/connectionStrings.php');
    include('../controler/sessionManagment/session.php');

?>
<html>
<head>
<?php include("../includes/pageIncludes/head-1.php");?>
</head>
<body>
    <?php include("../includes/pageIncludes/TopNav.php");?>
   
    <a href="../controler/logout.php">logout</a>
    <br>
    upload view photo
    <form enctype="multipart/form-data" action="../fileIO/upload.php" method="POST">
        <input type="file" name="uploaded_file"></input><br />
        <input type="submit" value="Upload"></input>
    </form>
    <hr>
    <br>
    <?php 
        echo '<pre>';
        var_dump($_SESSION);
        echo '</pre>';  
        
        if($_SESSION['browser'] == $_SERVER['HTTP_USER_AGENT']){echo "true: ";}echo $_SERVER['HTTP_USER_AGENT']."<br>";
       if($_SESSION['ip'] == get_client_ip_env()){echo "true: ";}echo get_client_ip_env()."<br>";
       if($_COOKIE['cookieId'] == $_SESSION['cookieId']){echo "true: ";}echo $_COOKIE['cookieId']."<br>";
    ?>
    <hr>
    <br>
    view photo<br>
    <img src="../fileIO/view_image.php?file=sheild-1.png" /><br>
    <?php
        $result = select_sqli('../',"SELECT * FROM images");
        while ($row = mysqli_fetch_assoc($result)) {
    ?>
        <!--<img src="download.php?img=<?php //echo $row['filename']?>" /><br>-->
        
        
        
        
        <a href="../fileIO/download.php?file=<?php echo $row['filename']?>"download><button>download <?php echo $row['filename']?> image</button></a>

      
        
    <?php
        }
    ?>

</body>
</html>