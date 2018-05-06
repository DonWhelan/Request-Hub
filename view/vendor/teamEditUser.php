<?php 
include("navHead.php"); 
include("../../model/selectModel_teamEditUser.php"); 
?>

        <!-- ======================= teamEditUser =========================== --> 
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="container-fluid">
        <!-- Start Page Content -->
        <div class="row">
            <div class="col-md-12">
                <div class="card p-30">
                    <div class="media">

                        <div class="media-left meida media-middle">
                            <span><i class="fa fa-users f-s-40 color-info"></i></span>
                        </div>
                        <div class="media-body media-text-right">
                            <h2>Edit Users</h2>
                        </div>

                    </div>
                    <br><br>
                    
                    <table class="table">
                    <thead>
                        <tr>
                          <th scope="col">User</th>
                          <th scope="col">email</th>
                          <th scope="col">Queues Assigned</th>
                          <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $company = $_SESSION['company'];
                            select_prepared_teamEditUser("../../",$company);
                        ?>
                    </tbody>
                </div>
            </div>
        </div>
    </div>

</main>
<?php include("navFoot.php"); ?>  