<?php

    if(!isset($_SESSION['accessQueues'])){
        if(isset($_SESSION['unTrustedUser'])){
                $teamsCSV = select_prepared_inboxSelectTeamFromUsersTransaction("../../", $_SESSION['user'], $_SESSION['company']);
        }else{
            // INSERT INTO company (name, address, address2, postcode, country) VALUES (?,?,?,?,?)"
            $teamsCSV = select_prepared_inboxSelectTeamFromUsers("../../", $_SESSION['user'], $_SESSION['company']);
            if(!$teamsCSV){
               // if unexpected results untrust user
               error_log("user untrusted:".$_SESSION['user']."-".$_SESSION['ip'], 0);
                $_SESSION['unTrustedUser'] = true;
            }
        }
        $teamsArray = explode(";", $teamsCSV);
        $qtyOfQueues = count($teamsArray);
        $_SESSION['accessQueues']['qty'] = $qtyOfQueues;
        $_SESSION['accessQueues']['array'] = $teamsArray;
    }
    //echo "<pre>";
    //print_r($_SESSION['accessQueues']);
    
    echo "<div class='row'>";
    foreach ($_SESSION['accessQueues']['array'] as $i) { 
    $teamName = select_prepared_inboxSelectTeamQueuesFromTeams("../../",$i);
    ?>
        <div class="col-md-5">
          <a href="teamCreate.php">
            <div class="card p-30">
                <div class="media">
                    <div class="media-left meida media-middle">
                        <span><i class="fa fa-plus-square f-s-40 color-primary"></i></span>
                    </div>
                    <div class="media-body media-text-right">
                        <h2><?php echo $teamName ?></h2>
                        <p class="m-b-0">Create Teams to assigne tasks</p>
                    </div>
                </div>
            </div>
            </a>
       </div>
    <?php }
    echo "<div>";
        
        
        


    // $array = select_prepared_inboxSelectTeamQueuesFromTeams("../../",8);
    
    // print_r($array);

    


?>