<?php 
include("../../model/selectModel_requestAddDropD.php"); 
include("navHead.php"); 
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
                        <form action="requestAdd.php" method="post" name="Login_Form" class="form-signin">
                            <div class="form-group">
                                <!-- Team Name -->
                                <label for="reqName" class="control-label"><strong>Request Name</strong></label>
                                <input type="text" class="form-control" id="reqName" name="reqName" placeholder="" required>
                            </div>

                            <div class="form-group">
                                <!-- Role -->
                                <label for="dis" class="control-label"><b>Description</b></label>
                                <input type="text" class="form-control" id="dis" name="dis" placeholder="" required>
                            </div>
                            
                            <div class="form-group">
                            <!-- Role -->
                            <label class="control-label"><b>Number of tasks</b></label><br>
                                <select name="qty">
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                                  <option value="6">6</option>
                                  <option value="7">7</option>
                                  <option value="8">8</option>
                                  <option value="9">9</option>
                                  <option value="10">10</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                            <label for="dis" class="control-label"><b>Information Form</b></label>
                            <textarea rows="4" cols="100" name="infoForm"></textarea>
                            </div>
                            
                            <div class="form-group float-right">
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