<?php include("navHead.php"); ?>
        <!-- ======================= team =========================== --> 
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="container-fluid">
            <!-- Start Page Content -->
            <div class="row">
                <div class="col-md-5">
                  <a href="teamCreate.php">
                    <div class="card p-30">
                        <div class="media">
                            <div class="media-left meida media-middle">
                                <span><i class="fa fa-plus-square f-s-40 color-primary"></i></span>
                            </div>
                            <div class="media-body media-text-right">
                                <h2>Create Team</h2>
                                <p class="m-b-0">Create Teams to assigne tasks</p>
                            </div>
                        </div>
                    </div>
                    </a>
               </div>                  
                <div class="col-md-5">
                    <a href="teamAddUser.php">
                    <div class="card p-30">
                        <div class="media">
                            <div class="media-left meida media-middle">
                                <span><i class="fa fa-user-plus f-s-40 color-warning"></i></span>
                            </div>
                            <div class="media-body media-text-right">
                                <h2>Add User</h2>
                                <p class="m-b-0">Add new users to add to customers</p>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        
          
            <!-- Start Page Content -->
            <div class="row">
              <div class="col-md-5">
                  <a href="teamEdit.php">
                    <div class="card p-30">
                        <div class="media">
                            <div class="media-left meida media-middle">
                                <span><i class="fa fa-edit f-s-40 color-success"></i></span>
                            </div>
                            <div class="media-body media-text-right">
                                <h2>Edit Teams</h2>
                                <p class="m-b-0">Edit existing teams</p>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
                
                 <div class="col-md-5">
                     <a href="teamEditUser.php">
                    <div class="card p-30">
                        <div class="media">
                            <div class="media-left meida media-middle">
                                <span><i class="fa fa-users f-s-40 color-info"></i></span>
                            </div>
                            <div class="media-body media-text-right">
                                <h2>Edit Users</h2>
                                <p class="m-b-0">Edit existing users</p>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
                
        </div>
        <div class="row">
            <div id="messageBox" class="col-md-10" style="height:50px">
                <?php include("../../controler/messageBox.php"); ?>
            </div>
         </div>
      </div>
    </main>
<?php include("navFoot.php"); ?>  