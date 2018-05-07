<?php 
    include("navHead.php"); 
    include("../../model/selectModel_profileView.php");
    include("../../controler/getUID.php"); 
    $uid = getUID($_GET['uid']);
    $requestArray = select_prepared_profileShowRequestByUID("../../", $uid,$_SESSION['company']);
    $total = $requestArray['requestObj']['totalTasks'] + 1;
    if($requestArray['taskHops'] == NULL){
        $curr = 0;
    }else{
        $curr = $requestArray['taskHops'] + 1;
    }
    $totalprogress = 100/$total;
    $percentCompleate = $curr * $totalprogress;
    if($requestArray['compleate']=="Compleate"){
        $percentCompleate = 100;
        $curr = $total;
    }
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
                            <span><i class="fa fa-user f-s-40 color-primary"></i></span>
                        </div>
                        <div class="media-body media-text-right">
                            <h2><?php echo $_SESSION['user'];//from:controler/inboxGetTeam.php?></h2>
                        </div>
                    </div>
                    <br><br>
                    <table class="table">
                    <thead>
                        <tr>
                          <th scope="col">Rid</th>
                          <th scope="col">Request</th>
                          <th scope="col">Steps</th>
                          <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <th scope='row'><?php echo $uid ?></th>
                      <td><?php echo $requestArray['name'] ?></td>
                      <td><?php echo $curr."/".$total; ?></td>
                      <td><?php echo $requestArray['compleate'] ?></td>
                    </tr>
                    </tbody>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php 
                    $text = str_ireplace(array("\r","\n",'\r','\n'),'<br>', $requestArray['infoForm']);
                    echo  "<h3>Form Information: <p>".$requestArray['name']."</p></h3><progress value='".$percentCompleate."' max='100' style='width:100%'></progress><hr>".$text."<br><br><hr>";
                    echo  "<h3>Currently With</h3><hr><br>".$requestArray['currentTask']." to ".$requestArray['currentActivity']."<br><br><hr>";
                ?>
            </div>
        </div>
    </div>
</main>
        
<?php include("navFoot.php"); ?>           