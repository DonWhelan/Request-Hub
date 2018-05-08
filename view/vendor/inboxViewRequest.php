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
                            <h2><?php echo $teamName; //from:controler/inboxGetTeam.php?></h2>
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
                            $infoForm = select_prepared_inboxGetRequestsFromRid("../../",$_SESSION['company'],$teamName,$rid,$qid)
                        ?>
                    </tbody>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php 
                    $text = str_ireplace(array("\r","\n",'\r','\n'),'<br>', $infoForm);
                    $task = select_prepared_inboxGetCurrentActivity("../../",$rid);
                ?>
                <h3>Form Information</h3><hr><?php echo $text ?><br><br><hr>
                <h3>Task</h3><hr><br><?php echo $task ?><br><br><hr>
            </div>
        </div>
    </div>
</main>
        
<?php include("navFoot.php"); ?>           