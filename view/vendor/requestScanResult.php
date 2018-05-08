<?php 
include("navHead.php"); 
include("../../controler/stegParce.php"); 
$result = $_GET['result'];
?>

<!-- ======================= dashboard =========================== --> 
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="container-fluid">
        <!-- Start Page Content -->
        <div class="row">
            <div class="col-md-12">
                <div class="card p-30">
                    <div class="media">
                        <div class="media-left meida media-middle">
                            <span><i class="fa fa-shield-alt f-s-40 color-danger"></i></span>
                        </div>
                        <div class="media-body media-text-right">
                            <h2>Data Loss</h2>
                        </div>
                    </div>
                    <br><br>
                    <h3>Scan Downloaded Files</h3>
                    <hr>
                    If file was downloaded from Reques Hub you can recover the information of the user who has downloaded it.
                    <br><br><span>
                   <?php  
                        stegParce($result);
                   ?>
                    <br>
                    <hr>

                </div>
            </div>
        </div>
    </div>
</main>
<?php include("navFoot.php"); ?>  