<?php
    if(isset($_GET["message"])){
        if($_GET["message"]=="success"){
        echo " <div class='alert alert-success text-center'>
         Team Saved <span><i class='fa fa-thumbs-up f-s-15'></i></span>
         </div>";
        }
        if($_GET["message"]=="teamError"){
        echo " <div class='alert alert-danger text-center'>
         Error setting up team <span><i class='fa fa-poo f-s-15'></i></span>
         </div>";
        }
        
    }
?>