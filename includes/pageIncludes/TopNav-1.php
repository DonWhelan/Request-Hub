<!--navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="../../index.php">Request-Hub <img src="../../images/icon.png" alt="" style="height:25px"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#">Admin</a>
                </li>
            </ul>
                 <?php if(!isset($_SESSION['user'])){?>
                <a href="../../../view/userLogin.php"><button class="btn btn-outline-info my-sm-0" type="submit">Login</button></a>
                <a href="../../../view/userRegister.php"><button class="btn btn-outline-info my-sm-0" type="submit">Create Account</button></a>
                <?php }else{ ?>
                <a href="../../../controler/logout.php"><button class="btn btn-outline-info my-sm-0" type="submit">Log out</button></a>
                <?php } ?>
        </div>
    </nav>