

profile:
<hr>
<br>
    <?php  
        if(isset($_GET['profile'])) {
            system("cat ".$_GET['profile']) ; 
        }
    ?> 
<br>
<a href="index.php?profile=shane.txt">shane</a>
<a href="index.php?profile=pep.txt">pep</a>
