<!DOCTYPE html>
<html>
  <head>
    <style>
      .strike {
      display: block;
      text-align: center;
      overflow: hidden;
      white-space: nowrap;
      }

      .strike > span {
          position: relative;
          display: inline-block;
      }

      .strike > span:before,
      .strike > span:after {
          content: "";
          position: absolute;
          top: 50%;
          width: 9999px;
          height: 1px;
          background: lightgrey;
      }

      .strike > span:before {
          right: 100%;
          margin-right: 15px;
      }

      .strike > span:after {
          left: 100%;
          margin-left: 15px;
      }
    </style>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-signin-client_id" content="YOUR_CLIENT_ID.apps.googleusercontent.com">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://apis.google.com/js/platform.js" async defer></script>

    <title>SnapComp - Login</title>

  </head>
  <body>
    <div class="container">
      <div class="panel-title text-center">
          <h1><font face="Segoe UI" size="30px">SnapComp</font></h1>
          <p>Pick a pic</p>
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
            <input id="LoginButton" type="submit" class="btn btn-primary btn-block" action="?controller=users&action=login" name="LoginButton" value="Log In">
          </div>
          <br>

          <div class="strike" style="width:250px; margin:auto;">
            <span><font color="lightgrey">OR</font></span>
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
  </body>
</html>
