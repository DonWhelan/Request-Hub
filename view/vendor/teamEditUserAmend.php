<?php 
    include("navHead.php"); 
    include("../../model/selectModel_requestAddRadioButtons.php"); 
    include("../../model/selectModel_teamEditUser.php"); 
    include("../../controler/getUID.php"); 
    
?>
        <!-- ======================= teamAddUser =========================== --> 
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
                    <?php
                        $comapny = $_SESSION['company'];
                        $uid = getUID($_GET['uid']);
                        $array = select_prepared_teamEditUserAmend("../../",$uid,$comapny);
                    ?>
                    
                    
                    <form action="../../controler/teamAmendUser.php?uid=<?php echo $uid; ?>" method="post" name="Login_Form" class="form-signin">
                        <div class="form-group">
                            <!-- Team Name -->
                            <label for="reqName" class="control-label"><strong>Username</strong></label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="" value="<?php echo $array['name']; ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <!-- Team Name -->
                            <label for="Email" class="control-label"><strong>Email</strong></label>
                            <input type="text" class="form-control" id="Email" name="email" placeholder="" value="<?php echo $array['email']; ?>" required>
                        </div>

                        <div class="form-group col-md-6 float-left">
                            <!-- Role -->
                            <label for="dis" class="control-label "><b>Password</b></label>
                            <input type="password" class="form-control" id="pw" name="pw" placeholder="" value="" >
                        </div>

                        <div class="form-group col-md-6 float-right">
                            <!-- Role -->
                            <label for="dis" class="control-label"><b>Password</b></label>
                            <input type="password" class="form-control" id="pwMatch" name="pwMatch" placeholder="" value="" >
                        </div>

                        <div class="checkbox" name="test">
                            
                        <?php
                            select_prepared_teamRadioButtonsAmend("../../",$array['teams'],$comapny);
                        ?>
                        <div class="form-group float-right">
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include("navFoot.php"); ?>  