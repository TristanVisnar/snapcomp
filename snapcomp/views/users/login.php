<!--<html>
  <head>-->
    <title>SnapComp - Login</title>

  <!--</head>
  <body>-->
    <div class="container">
      <div class="panel-title text-center">
          <h1><font face="Segoe UI" size="30px">SnapComp</font></h1>
          <p><i>"Pick a pic"</i></p>
      </div>
      <hr>
      <div>
        <form action="?controller=users&action=login" method="POST">
          <div class="input-group" style="width:250px; margin:auto">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input id="LoginAccountName" type="text" required="true" class="form-control" name="ACCNAME" placeholder="Account Name">
          </div>
          <br>

          <div class="input-group" style="width:250px; margin:auto">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input id="LoginPassword" type="password" required="true" class="form-control" name="PASS" placeholder="Password">
          </div>
          <br>

		  <div style="width:250px; margin:auto">
			<?php
				if(isset($_GET["error"]))
					echo "<p><font color='red' size='2px'>Error logging in. Please, try again </font></p>";
			?>
		  </div>

          <div style="width:250px; margin:auto">
            <input id="LoginButton" type="submit" class="btn btn-primary btn-block" style="background-color:#9aff28; border:0px; color:black;" action="?controller=users&action=login" name="LoginButton" value="Log In">
          </div>
          <br>

          <div class="strike" style="width:250px; margin:auto;">
            <span><font color="#ff7b00">OR</font></span>
          </div>
          <br>

          <div>
            <div style="width:250px; margin:auto;" class="g-signin2" data-onsuccess="onSignIn" data-longtitle="true"></div>
          </div>
          <br>

          <div style="width:250px; margin:auto; text-align:center">
            <a href="register.php"><u>Create a new account</u></a>
          </div>

          <div style="width:250px; margin:auto; text-align:center">
            <a href="#"><u>Forgot your password?</u></a>
          </div>
        </form>
      </div>
    </div>
  <!--</body>
</html>-->
