<?php
    session_start();
    include('../model/connectionStrings.php');
    //include('../controler/sessionManagment/session.php');   
    
?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Request Hub</title>

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
                <form action="../controler/newCompanyRegister.php" method="post" name="Login_Form" class="form-signin">
                    <img class="mb-4" src="../assets/img/icons/services-1.png" alt="" width="72" height="72">
                    <h1 class="h3 mb-3 font-weight-normal">Company details</h1>
                    <input type="text" class="form-control" name="companyName" placeholder="Company name" required="" />
                    <input type="text" class="form-control" name="address" placeholder="Address" required="" />
                    <input type="text" class="form-control" name="address2" placeholder="Address 2 (optional)"  />
                    <input type="text" class="form-control" name="postcode" placeholder="Postcode" required="" />
                    <input type="text" class="form-control" name="country" placeholder="Country" required="" />
                    <button class="btn btn-lg btn-primary btn-block" type="submit" value="Login">Register</button>
                    <p class="mt-5 mb-3 text-muted">&copy; 2018</p>
                </form>
            </div>
        </div>
    </div>
</body>

</html>