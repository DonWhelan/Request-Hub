<?php 
    include("navHead.php"); 
    include("../../model/selectModel_inboxSelectTeams.php"); 
    include("../../model/selectModel_inboxSelectgGetContent.php"); 
    
    
?>

    <!-- ======================= dashboard =========================== --> 
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="container-fluid">
            <!-- Start Page Content -->

            <?php include("../../controler/inboxView.php");?>
            
            <div class="row">
                <div id="messageBox" class="col-md-10" style="height:50px">
                    <?php include("../../controler/messageBox.php"); ?>
                </div>
            </div>
        </div>
    </main>
        
<?php include("navFoot.php"); ?>           