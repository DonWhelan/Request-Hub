<?php include("navHead.php"); ?>

        <!-- ======================= dashboard =========================== --> 
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="container-fluid">
                <!-- Start Page Content -->
                <div class="row">
                    <div class="col-md-5">
                        <a href="requestName.php">
                        <div class="card p-30">
                            <div class="media">
                                <div class="media-left meida media-middle">
                                    <span><i class="fa fa-plus-square f-s-40 color-primary"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2>Create Form</h2>
                                    <p class="m-b-0">Create forms for customers</p>
                                </div>
                            </div>
                        </div>
                        </a>
                   </div>
              
                    <div class="col-md-5">
                        <a href="requestEdit.php">
                        <div class="card p-30">
                            <div class="media">
                                <div class="media-left meida media-middle">
                                    <span><i class="fa fa-edit f-s-40 color-success"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2>Edit Form</h2>
                                    <p class="m-b-0">Edit existing forms</p>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-5">
                        <a href="requestScan.php">
                        <div class="card p-30">
                            <div class="media">
                                <div class="media-left meida media-middle">
                                    <span><i class="fa fa-shield-alt f-s-40 color-danger"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2>Data Loss</h2>
                                    <p class="m-b-0">Scan recovered data</p>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div id="messageBox" class="col-md-10" style="height:50px">
                        <?php include("../../controler/messageBox.php"); ?>
                    </div>
                </div>
            </div>
        </main>
        
<?php include("navFoot.php"); ?>           