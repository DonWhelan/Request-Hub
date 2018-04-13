
<?php 
//include("../../../model/selectModel.php"); 
include("../../../model/selectModel_teamEdit.php"); 
include("navHead.php"); 
//selectConnectionString("../");
?>
    <!-- ======================= teamCreate =========================== -->
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="container-fluid">
            <!-- Start Page Content -->
            <div class="card p-30">
                <div class="row">
                    <div class="col-md-12">
                        <div class="media">
                            <div class="media-left meida media-middle">
                                <span><i class="fa fa-edit f-s-40 color-success"></i></span>
                            </div>
                            <div class="media-body media-text-right">
                                <h2>Edit Team</h2>
                            </div>
                        </div>
                        <br>
                        <br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-1">
                    </div>

                    <div class="col-md-10">
                        <?php
                            $uidFromURL = $_GET['uid'];
                            $array = select_prepared_teamEdit_byUID("../../../",$uidFromURL);
                        ?>

                        <form action="../../../controler/teamUpdate.php" method="post" name="Login_Form" class="form-signin">
                            <div class="form-group">
                                <!-- Team Name -->
                                <label for="teamName" class="control-label"><strong>Team Name</strong></label>
                                <input type="text" class="form-control" id="teamName" name="teamName" value="<?php echo $array['teamName']; ?>" required>
                            </div>

                            <div class="form-group">
                                <!-- Role -->
                                <label for="role" class="control-label"><b>Role</b></label>
                                <input type="text" class="form-control" id="role" name="role" value="<?php echo $array['role']; ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <!-- HIDDEN UID -->
                                <input type="hidden" class="form-control" id="uid" name="uid" value="<?php echo $uidFromURL?>" required>
                            </div>

                            <div class="form-group float-right">
                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>

    </main>
<?php include("navFoot.php");?>