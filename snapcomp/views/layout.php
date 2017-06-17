﻿<DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <meta name="google-signin-client_id" content="YOUR_CLIENT_ID.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <link href='https://fonts.googleapis.com/css?family=Satisfy' rel='stylesheet'>
  </head>

  <script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip({ placement:""; });
    });
  </script>
   <style>
    .navbar {
  	  background-color: #9aff28;
  	  color: black;
      margin-bottom: 0;
  	  border-color: rgba(255, 255, 255, 0);
    }

    .row.content {height: 600px}
    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 100%;
    }

    footer
    {
      background-color: rgb(255, 123, 0);
	    color: black;
      height:52px;
      padding-top: 15px;
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

   .nav.navbar-nav.navbar-right li a
   {
     color: black;
   }

    .strike
    {
    display: block;
    text-align: center;
    overflow: hidden;
    white-space: nowrap;
    }

    .strike > span
    {
        position: relative;
        display: inline-block;
    }

    .strike > span:before,
    .strike > span:after
    {
        content: "";
        position: absolute;
        top: 50%;
        width: 9999px;
        height: 1px;
        background: #ff7b00;
    }

    .strike > span:before
    {
        right: 100%;
        margin-right: 15px;
    }

    .strike > span:after
    {
        left: 100%;
        margin-left: 15px;
    }

    hr {
      border-color:#ff7b00;
    }

  </style>
  <body><!--style="background-color: rgba(255, 213, 89, 0.1)">-->
	<nav class="navbar navbar-inverse navbar-static-top">
	<div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a style="color:black;"  class="navbar-brand" href="?controller=pages&action=home">SnapComp</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <!--<li><a href="?controller=pages&action=browse"><span class="glyphicon glyphicon-search"></span> Browse</a></li>-->
		    <li><a style="color:black;" href="?controller=users&action=getTop10Users">Highscores</a></li>
        <li><a style="color:black;" href="#">Picture of the Day</a></li>
        <li><a style="color:black;" href="?controller=images&action=browse&sort=top">Top Content</a></li>
        <li><a style="color:black;" href="?controller=images&action=browse&sort=new">New Content</a></li>
      </ul>
	   <ul class="nav navbar-nav navbar-right">
        <?php
          session_start();
		//var_dump($_SESSION);
          if(isset($_SESSION["USERNAME"]))
			echo "<li><a href='?controller=users&action=profileUser'>". $_SESSION["ACCNAME"]." (".$_SESSION["USERNAME"].") </a><a href='?controller=users&action=logout'>(Logout)</a></li>";
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
<!--<div><a href="?controller=users&action=getUser&id=1">Krnekilink</a></div>-->
<footer>
    <p style="width:178px; margin-left:auto; margin-right:auto;">
      SnapComp - <font face="Satisfy">"Pick a pic"</font> ™
    </p>
</footer>
<body>
</html>
