<?php 
    include("navHead.php"); 
    include("../../model/selectModel_profile.php");
    include("../../controler/inboxGetTeam.php"); 
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
                            <span><i class="fa fa-user f-s-40 color-primary"></i></span>
                        </div>
                        <div class="media-body media-text-right">
                            
                            <h2><?php echo $_SESSION['user']; //from:controler/inboxGetTeam.php?></h2>
                        </div>
    
                    </div>
                    <br><br>
                    <div>
                    <table class="table">
                    <thead>
                        <tr>
                          <th scope="col"><h4><b>Rid</b></h4></th>
                          <th scope="col"><h4><b>Request</b></h4></th>
                          <th scope="col"><h4><b>Time</b></h4></th>
                          <th scope="col"><h4><b>Status</b></h4></th>
                          <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            select_prepared_profileShowRequests("../../",$_SESSION['company'],$_SESSION['user'])
                        ?>
                    </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
        
<?php include("navFoot.php"); ?>           