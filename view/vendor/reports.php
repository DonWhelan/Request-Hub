<?php 
include("../../model/selectModel_requestView.php"); 
include("navHead.php"); 
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
                            <h2>Requests</h2>
                        </div>

                    </div>
                    <br><br>

                        <?php
                            // model prints existing Teams
                            $comapny = $_SESSION['company'];
                            select_prepared_requestView("../../",$comapny);
                        ?>
       
                    </ul>
                    
                </div>
            </div>
        </div>
    </div>

</main>
<?php include("navFoot.php"); ?>  