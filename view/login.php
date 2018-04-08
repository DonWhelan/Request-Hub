
<html>
<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    
</head>


<div class = "container">
	<h1>Existing user</h1>
	<div class="wrapper">
		
		<form action="indexLoginVal.php" method="post" name="Login_Form" class="form-signin" >       
		     <h3 class="form-signin-heading">Please Sign In</h3>
			  <hr class="colorgraph"><br>
			  
			  <input type="text" class="form-control" name="username" placeholder="Username" required="" autofocus="" />
			  <input type="password" class="form-control" name="password" placeholder="Password" required=""/>     		  
			 
			  <button class="btn btn-lg btn-primary btn-block"  name="Submit" value="Login" type="Submit">Login</button>  			
		</form>
		
	</div>
</div>

<div class = "container">
	<h1>New user</h1>
	<div class="wrapper">
		
		<form action="newUser.php" method="post" name="Login_Form" class="form-signin" >       
		     <h3 class="form-signin-heading">Please Sign Up</h3>
			  <hr class="colorgraph"><br>
			  
			  <input type="text" class="form-control" name="username" placeholder="Username" required="" autofocus="" />
			  <input type="password" class="form-control" name="password" placeholder="Password" required=""/>   
			  <input type="password" class="form-control" name="passwordmatch" placeholder="Password" required=""/>  
			  <input type="text" class="form-control" name="email" placeholder="email" required=""/>  
			 
			  <button class="btn btn-lg btn-primary btn-block"  name="Submit" value="Login" type="Submit">Login</button>  			
		</form>
		
	</div>
</div>
<br>








</html>
