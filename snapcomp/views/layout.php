<DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script></head>
  <script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip({ placement:""; });
    });
  </script>
   <style>
    .navbar {
	  background-color: #333333;
	  color: black;
	  
      margin-bottom: 0;
      border-radius: 0;
    }
    .row.content {height: 600px}
    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 100%;
    }

    footer {
      background-color: #0099cc;
      color: white;
      padding: 15px;
	  color: black;
	  
    }

    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {
		  height:auto;
	  }
    }
	
    .test + .tooltip > .tooltip-inner {
       background-color: #000000;
       color: #FFFFFF;
   }

  </style>
  <body>
	<nav class="navbar navbar-inverse">
	<div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="?controller=pages&action=home">Snapcomp</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="?controller=pages&action=browse"><span class="glyphicon glyphicon-search"></span> Browse</a></li>
		<li><a href="#">Highscores</a></li>
        <li><a href="#">Picture of the day</a></li>
      </ul>
	   <ul class="nav navbar-nav navbar-right">
        <?php
          session_start();
		var_dump($_SESSION);
          if(isset($_SESSION["USERNAME"]))
			echo "<li><a href='?controller=users&action=profileUser'>Logged in as: ". $_SESSION["ACCNAME"]." (".$_SESSION["USERNAME"].") </a></li>";
          else
	  {
	      echo "<li><a href='?controller=pages&action=login'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>";
              echo "<li><a href='?controller=pages&action=register'><span class='glyphicon glyphicon-user'></span> Register</a></li>";
          }
        ?>
      </ul>
    </div>
	</div>
	</nav>

  <?php require_once("routes.php"); ?>
  </div>
</div>
<div><a href="?controller=users&action=getUser&id=1">Krnekilink</a></div>
<footer class="container-fluid text-center">
  <p>Snapcomp - "Slogan" ™</p>
</footer>
<body>
</html>
