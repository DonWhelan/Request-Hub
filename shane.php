<?php
$a = 0;

while($a < 10){

    ?>


<form action="https://www.edyoucate.ie//register.php" method="post" name="registration_form">
                  Username: <input type='text' name='username' id='username' value='hello'/><br>
                  Email: <input type="text" name="email" id="email" value='asdfdaf@adsf.asdf'/><br>
                  Password: <input type="password" name="password" id="password" value='passwO0rq!1'/><br>
                  Confirm password: <input type="password" name="confirmpwd" id="confirmpwd" value='passwO0rq!1'/><br>
                  <!--<input type="button" -->
                  <!--   value="Register" -->
                  <!--   onclick="return regformhash(this.form,-->
                  <!--   this.form.username,-->
                  <!--   this.form.email,-->
                  <!--   this.form.password,-->
                  <!--   this.form.confirmpwd);" /> -->
               </form>

<?php
    $a++;
    
}
?>