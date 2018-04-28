<?php 
include("../../model/selectModel_requestAddDropD.php"); 
include("navHead.php"); 
$qty = "";
$reqName = "";
$dis = "";
$qty = $_POST['qty'];
$reqName = $_POST['reqName'];
$dis = $_POST['dis'];


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
                                <span><i class="fa fa-plus-square f-s-40 color-primary"></i></span>
                            </div>
                            <div class="media-body media-text-right">
                                <h2>Create Form</h2>
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
                        <form action="../../controler/requestAdd.php" method="post" name="Login_Form" class="form-signin">
                            <?php 
                                $displayNum = 1;
                                for( $i = 0; $i<$qty; $i++ ) {
                                    ?>
                                    
                                    <div class="form-group">
                                        <!-- Team0 -->
                                        <h2>Task <?php echo $displayNum; ?></h2>
                                        <select name="Team<?php echo $i; ?>">
                                            <?php
                                                $comapny = $_SESSION['company'];
                                                select_prepared_teamDropDown("../../",$comapny);
                                             ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <!-- action0 -->
                                        <label for="action<?php echo $i; ?>" class="control-label"><b>Action</b></label>
                                        <input type="text" class="form-control" id="action<?php echo $i; ?>" name="action<?php echo $i; ?>" placeholder="" required>
                                    </div>
                                    <br>
                                       
                                    <?php
                                    $displayNum++;
                                    
                                }
                            ?>
                            <div class="form-group float-right">
                            <input type="hidden" class="form-control" id="qty" name="qty" value="<?php echo $qty ?>" placeholder="" required>  
                            <input type="hidden" class="form-control" id="reqName" name="reqName" value="<?php echo $reqName ?>" placeholder="" required> 
                            <input type="hidden" class="form-control" id="dis" name="dis" value="<?php echo $dis ?>" placeholder="" required> 
                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
            <div id="messageBox" class="col-md-10" style="height:50px">
                <?php include("../../controler/messageBox.php"); ?>
            </div>
         </div>
        </div>

    </main>
<?php include("navFoot.php");?>