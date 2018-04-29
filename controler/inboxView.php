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
    
    $countOfQueues = 0;
    echo "<div class='row'>";
    foreach ($_SESSION['accessQueues']['array'] as $i) { 
        $teamName = select_prepared_inboxSelectTeamQueuesFromTeams("../../",$i);
        $qtyOfRequests = select_prepared_inboxSelectQtyOfRequets("../../",$teamName);
        ?>
            <div class="col-md-5">
              <a href="inboxView.php?Qid=<?php echo $i; ?>">
                <div class="card p-30">
                    <div class="media">
                        <div class="media-left meida media-middle">
                            <?php 
                                if($qtyOfRequests > 0){ 
                                    echo "<span><i class='fa fa-bars f-s-40 color-primary'></i></span>"; 
                                }else{
                                    echo "<span><i class='fa fa-bars f-s-40 color-secondary'></i></span>"; 
                                }
                            ?>
                        </div>
                        <div class="media-body media-text-right">
                            <h2><?php echo $teamName; ?></h2>
                            <p class="m-b-0"><?php if($qtyOfRequests > 0){ echo "Request pending: ".$qtyOfRequests; }?></p>
                        </div>
                    </div>
                </div>
                </a>
           </div>
        <?php
        
        $countOfQueues++;
        if($countOfQueues == $_SESSION['accessQueues']['qty']){
            echo "</div>";
        }
        if($countOfQueues % 2 == 0){
            echo "</div><div class='row'>";
        }
    }
?>