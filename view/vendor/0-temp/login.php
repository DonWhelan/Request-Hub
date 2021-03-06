<?php
    session_start();
    include('../../../model/connectionStrings.php');
    $subject = $_SERVER['REQUEST_URI'] ;
    $search = '/view/vendor/' ;
    $trimmed = str_replace($search, '', $subject) ;
    $subject = $trimmed ;
    $search = '/login.php' ;
    $company = str_replace($search, '', $subject) ;
    $mystring = $company; 
    $parts = explode("?",$mystring); 
    $company = $parts['0']; 
?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include("../../../includes/pageIncludes/head-customer.php");?>

    <!-- Bootstrap core CSS -->
    <link href="../../../style/bootstrap-4.0.0-dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
    <script>
      $(document).ready(function(){
                $(".alert").delay(1500).fadeToggle("slow");
      });
    </script>
</head>

<body class="text-center">
    
    <?php
		include("../../../includes/pageIncludes/TopNavcustomer.php");
	?>
    
    <div class="container">
        <div class="row">
            <div class="col-sm-12" style="height:130px">
                <div id="messageBox" class="col-md-12" style="height:50px">
                    <?php include("../../../controler/messageBox.php"); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-4">
                <form action="../../../controler/customerLoginVal.php" method="post" name="Login_Form" class="form-signin">
                    <img class="mb-4" src="../../../assets/img/icons/services-1.png" alt="" width="72" height="72">
                    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
                    <input type="text" class="form-control" name="username" placeholder="Username" required="" autofocus="" />
                    <input type="password" class="form-control" name="password" placeholder="Password" required="" />
                    <input type="hidden" class="form-control" name="company" value="<?php echo $company ?>" />
                    <button class="btn btn-lg btn-primary btn-block" type="submit" value="">Sign in</button>
                    <p class="mt-5 mb-3 text-muted">&copy; 2018</p>
                </form>
            </div>
        </div>
    </div>

</body>

</html>