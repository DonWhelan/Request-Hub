<?php 
//include("../../model/selectModel_requestEdit.php"); 

include("navHead.php"); 
include("../../model/selectModel_requestAddDropD.php"); 
//include("../../model/selectModel.php"); 
function select_prepared_requestEditView($dir,$uid) {

        include($dir."../pem/sqlSelect.php");
        $connection = mysqli_connect(sHOST, sUSER, sPASS);
        if (!$connection) {
            trigger_error("Could not reach database!<br/>");
            error_log("Could not connect! select_prepared_teamEdit(),", 0);
            exit();
        }
        $db_selected = mysqli_select_db($connection, sDB);
        if (!$db_selected) {
            trigger_error("Could not reach database!<br/>");
            error_log("Could not connect! select_prepared_teamEdit(),", 0);
            exit();
        }
        /* check connection */
        if (mysqli_connect_errno($connection)) {
            error_log("Could not connect! select_prepared_teamEdit(),", 0);
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
        
        /*
         * We have created a view of the users table called userLogonView. It only has access to username and password colums,
         * if details of the query were exploited only u-name and p-word would be exposed and no other personal information.
         */

        if ($stmt = mysqli_prepare($connection, "SELECT name, description, infoForm, currentTask, requestObj FROM portfolios WHERE uid = ?")) {
            mysqli_stmt_bind_param($stmt, "i", $uid);
            mysqli_stmt_execute($stmt);
            $resultName = "";
            $resultDescription = "";
            $reseultinfoForm = "";
            $reseultcurrentTask = "";
            $reseultrequestObj = "";
            $returnArray = "";
            mysqli_stmt_bind_result($stmt, $resultName, $resultDescription, $reseultinfoForm, $reseultcurrentTask, $reseultrequestObj);   
            while (mysqli_stmt_fetch($stmt)) {
                $unserializeArray = unserialize(base64_decode($reseultrequestObj));
                $returnArray = ['name' => $resultName,
                                'description' => $resultDescription, 
                                'infoForm' => $reseultinfoForm, 
                                'currentTask' => $reseultcurrentTask, 
                                'requestObj' => $unserializeArray ];
                return $returnArray;                
            }
            return $returnArray;
            mysqli_stmt_close($stmt);
        }
       mysqli_close($connection);
    }
    function getUID(){
     if(isset($_GET['uid'])){                   
            $UNTRUSTED_qid = $_GET['uid'];
            $subjectQID = stripslashes(trim($UNTRUSTED_qid));
            $uid = escape_data("../../",$subjectQID);
            return $uid;
            //  Model: selectModel_requestEditForm.php
            // "SELECT name, description, infoForm, currentTask, requestObj FROM portfolios WHERE uid = ?"
            //$requestArray = select_prepared_requestEditView("../../",$uid);
        }
    }
 
    $uid = getUID();
    $requestArray = select_prepared_requestEditView("../../",$uid);
     //echo $uid."<pre>";
    // print_r($requestArray);
     $count = $requestArray['requestObj']['totalTasks'] + 1;
     //echo $count;
     
?>

 <!--======================= dashboard =========================== -->
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
   <div class="container-fluid">
             <!--Start Page Content -->
            <div class="card p-30">
                <div class="row">
                    <div class="col-md-12">
                        <div class="media">
                             <div class="media-left meida media-middle">
                            <span><i class="fa fa-edit f-s-40 color-success"></i></span>
                        </div>
                        <div class="media-body media-text-right">
                            <h2>Edit Forms</h2>
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
                        <form action="../../controler/requestUpdate.php?uid=<?php echo $uid; ?>" method="post" name="Login_Form" class="form-signin">
                            <div class="form-group">
                                 
                                <label for="reqName" class="control-label"><strong>Request Name</strong></label>
                                <input type="text" class="form-control" id="reqName" name="reqName" placeholder="" value ="<?php echo $requestArray['name']; ?>" required>
                            </div>

                            <div class="form-group">
                                 
                                <label for="dis" class="control-label"><b>Description</b></label>
                                <input type="text" class="form-control" id="dis" name="dis" placeholder="" value ="<?php echo $requestArray['description']; ?>"required>
                            </div>
                            
                            <div class="form-group">
                            <label for="dis" class="control-label"><b>Information Form</b></label>
                            <textarea rows="4" cols="100" name="infoForm" ><?php echo $requestArray['infoForm']; ?></textarea>
                            </div>

                            <?php 
                                $displayNum = 1;
                                for( $i = 0; $i<$count; $i++ ) {
                            ?>
                                    <div class="form-group">
                                        <!-- Team0 -->
                                        <h2>Task <?php echo $displayNum; ?></h2>
                                        <select name="Team<?php echo $i; ?>">
                                            <option value="" selected >Choose Team</option>
                                            <?php
                                                $comapny = $_SESSION['company'];
                                                select_prepared_teamDropDown("../../",$comapny);
                                             ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <!-- action0 -->
                                        <label for="action<?php echo $i; ?>" class="control-label"><b>Action <?php echo $displayNum; ?></b></label>
                                        <input type="text" class="form-control" id="action<?php echo $i; ?>" name="action<?php echo $i; ?>" placeholder="" value="<?php echo $requestArray['requestObj']['tasks']['action'.$i]; ?>" required>
                                    </div>
                                    <br>
                            <?php
                                    $displayNum++;
                                }
                                
                            ?>
                            <input type="hidden" class="form-control" id="qty" name="qty" value="<?php echo $displayNum-1; ?>"/>
                            <div class="form-group float-right">
                                <button type="submit" class="btn btn-primary">Update</button>
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
<?php include("navFoot.php"); ?>  