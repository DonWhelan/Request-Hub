<?php include("navHead.php"); ?>

        <!-- ======================= dashboard =========================== --> 
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            <div class="container-fluid">
                <!-- Start Page Content -->
                <div class="row">
                  
                    <div class="col-md-5">
                        <div class="card p-30">
                            <a href="customersAdd.php">
                            <div class="media">
                                <div class="media-left meida media-middle">
                                    <span><i class="fa fa-plus-square f-s-40 color-primary"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2>Create Customer</h2>
                                    <p class="m-b-0">Create customers to assign requests</p>
                                </div>
                            </div>
                            </a>
                        </div>
                   </div>
              
                    <div class="col-md-5">
                        <div class="card p-30">
                            <a href="customersEdit.php">
                            <div class="media">
                                <div class="media-left meida media-middle">
                                    <span><i class="fa fa-edit f-s-40 color-success"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2>Edit Customers</h2>
                                    <p class="m-b-0">Edit existing customer details</p>
                                </div>
                            </div>
                            </a>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="row">
                <div id="messageBox" class="col-md-10" style="height:50px">
                <?php include("../../controler/messageBox.php"); ?>
                </div>
            </div>
        </main>
        
<?php include("navFoot.php"); ?>       