<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Signin Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="../style/bootstrap-4.0.0-dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
</head>

<body class="text-center">
    <div class="container">
        <div class="row">
            <div class="col-sm-12" style="height:130px">
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-4">
                <form action="../indexLoginVal.php" method="post" name="Login_Form" class="form-signin">
                        
                        
  <!--                      		<form action="indexLoginVal.php" method="post" name="Login_Form" class="form-signin" >       -->
		<!--     <h3 class="form-signin-heading">Please Sign In</h3>-->
		<!--	  <hr class="colorgraph"><br>-->
			  
		<!--	  <input type="text" class="form-control" name="username" placeholder="Username" required="" autofocus="" />-->
		<!--	  <input type="password" class="form-control" name="password" placeholder="Password" required=""/>     		  -->
			 
		<!--	  <button class="btn btn-lg btn-primary btn-block"  name="Submit" value="Login" type="Submit">Login</button>  			-->
		<!--</form>-->
		
		
                    <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
                    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
                    <label for="inputEmail" class="sr-only">Email address</label>
                    <input type="text" class="form-control" name="username" placeholder="Username" required="" autofocus="" />
                    <label for="inputPassword" class="sr-only">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password" required=""/>   
                    <div class="checkbox mb-3">
                    </div>
                    <button class="btn btn-lg btn-primary btn-block" type="submit" value="Login">Sign in</button>
                    <p class="mt-5 mb-3 text-muted">&copy; 2018</p>
                </form>
            </div>
        </div>
    </div>

</body>

</html>