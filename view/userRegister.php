<?php
    session_start();
    include('../model/connectionStrings.php');
    //include('../controler/sessionManagment/session.php');
?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include("../includes/pageIncludes/head-1.php");?>

    <!-- Bootstrap core CSS -->
    <link href="../style/bootstrap-4.0.0-dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
    <script src="../assets/js/jquery-1.10.2.min.js"></script>
    <script>
      $(document).ready(function(){
                $(".alert").delay(1500).fadeToggle("slow");
      });
    </script>
</head>

<body class="text-center">

    <?php
		include("../includes/pageIncludes/TopNav.php");
	?>
        <div class="container">
            <div class="row">
                <div class="col-sm-12" style="height:130px">
                <div id="messageBox" class="col-md-12" style="height:50px">
                    <?php include("../controler/messageBox.php"); ?>
                </div>
            </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-4">
                    <form action="../controler/newUser.php" method="post" name="Login_Form" class="form-signin">
                        <img class="mb-4" src="../assets/img/icons/services-1.png" alt="" width="72" height="72">
                        <h1 class="h3 mb-3 font-weight-normal">Please enter your details</h1>
                        <label for="inputEmail" class="sr-only">Email address</label>
                        <input type="text" class="form-control" name="email" placeholder="Email" required="" />

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                            </div>
                            <input type="text" class="form-control" id="validationCustomUsername" placeholder="Username" name="username" aria-describedby="inputGroupPrepend" required>
                        </div>
                        <label for="inputPassword" class="sr-only">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password" required="" />
                        <input type="password" class="form-control" name="passwordmatch" placeholder="Confirm Password" required="" />
                        <div class="checkbox mb-3">
                        </div>
                        <button class="btn btn-lg btn-primary btn-block" type="submit" value="Login">Register</button>
                        <p class="mt-5 mb-3 text-muted">&copy; 2018</p>
                    </form>
                </div>
            </div>
        </div>

</body>

</html>