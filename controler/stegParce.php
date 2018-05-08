<?php 

    function stegParce($result){
        if($result == "null"){
            echo "<hr><h3>No Record Of File</h3>";
        }else{
            $array = explode("-",$result);
            $user = $array[0];
            $ip = $array[1];
            $date = gmdate("D M j Y", $array[2]);
            $time = gmdate("G:i:s", $array[2]);
            //times-circle no 
            //thumbs-up yes
            ?>
            <hr>
            <h3>File Downloaded from Request Hub</h3>
            <hr>
            <table class="table">
              <thead>
                <tr>
                  <th>Username</th>
                  <th>IP Address</th>
                  <th>Date</th>
                  <th>Time   </th>
                </tr>
              </thead>  
              <tbody>
                <tr>
                  <td><?php echo $user;?></td>
                  <td><?php echo $ip;?></td>
                  <td><?php echo $date;?></td>
                  <td><?php echo $time;?></td>
                </tr>
              </tbody>
            </table>
            <?php
            
        }
        
        
    }

?>