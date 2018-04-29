<?php 
    include("navHead.php"); 
    include("../../model/selectModel_inboxShowRequests.php");
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
                            <span><i class="fa fa-bars f-s-40 color-primary"></i></span>
                        </div>
                        <div class="media-body media-text-right">
                            <h2><?php echo $teamName; ?></h2>
                        </div>
    
                    </div>
                    <br><br>

                    <table class="table">
                    <thead>
                        <tr>
                          <th scope="col">Rid</th>
                          <th scope="col">Request</th>
                          <th scope="col">Submitter</th>
                          <th scope="col">Company</th>
                          <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            select_prepared_inboxGetRequestsForTeam("../../",$_SESSION['company'],$teamName)
                        ?>
                    </tbody>
                </div>
            </div>
        </div>
    </div>
</main>
        
<?php include("navFoot.php"); ?>           