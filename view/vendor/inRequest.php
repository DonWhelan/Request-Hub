<?php 
include("../../model/selectModel_inRequestView.php"); 
include("navHead.php"); 
include("../../controler/inRequestDisplayForm.php"); 
//include("../../model/inRequestView.php"); 
$IMid = "";
if(isset($_GET['imageID'])){
    $IMid = $_GET['imageID'];
    $IMid = getImageID($IMid);
}else{
    $IMid = false;
}
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
                            <span><i class="fa fa-edit f-s-40 color-success"></i></span>
                        </div>
                        <div class="media-body media-text-right">
                            <h2>Edit Team</h2>
                        </div>

                    </div>
                    <br><br>

                        <?php
                            $UCid = $_GET['formid'];
                            showRequest($UCid, $IMid);
                            //select_prepared_requestView("../../",$comapny);
                        ?>
       
                    </ul>
                    
                </div>
            </div>
        </div>
    </div>

</main>
<?php include("navFoot.php"); ?>  