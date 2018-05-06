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
        if($_GET["message"]=="incorrect"){
        echo " <div class='alert alert-warning text-center'>
         Incorrect details <span><i class='fa fa-poo f-s-15'></i></span>
         </div>";
        }
        if($_GET["message"]=="char"){
        echo " <div class='alert alert-warning text-center'>
         Some charicters input cannot be used<span><i class='fa fa-poo f-s-15'></i></span>
         </div>";
        }
        if($_GET["message"]=="error"){
        echo " <div class='alert alert-danger text-center'>
         A error has occured <span><i class='fa fa-poo f-s-15'></i></span>
         </div>";
        }
        if($_GET["message"]=="username"){
        echo " <div class='alert alert-info text-center'>
        That username is already taken<span><i class='fa fa-poo f-s-15'></i></span>
         </div>";
        }
        if($_GET["message"]=="reqSucess"){
        echo " <div class='alert alert-success text-center'>
        request Created<span><i class='fa fa-poo f-s-15'></i></span>
         </div>";
        }
        if($_GET["message"]=="pwmatch"){
        echo " <div class='alert alert-info text-center'>
        Passwords did not Match<span><i class='fa fa-poo f-s-15'></i></span>
         </div>";
        }
        if($_GET["message"]=="userAdded"){
        echo " <div class='alert alert-success text-center'>
        New User Added <span><i class='fa fa-poo f-s-15'></i></span>
         </div>";
        }
        if($_GET["message"]=="updated"){
        echo " <div class='alert alert-success text-center'>
        User Updated <span><i class='fa fa-poo f-s-15'></i></span>
         </div>";
        }
        
    }
?>