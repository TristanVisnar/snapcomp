<?php
  include('../../parser/pharse/pharse.php');
  //include 'RedditRandomParser.php';
  include('TheGuardianParser.php');
  include('TheSunParser.php');
  //include('TheSunShowbizParser.php');

  $servername = "localhost";
  $username = "user";
  $password = "joomladb";
  $dbname = "snapcomp";
  $conn = new mysqli($servername, $username, $password, $dbname);
  $conn->query("TRUNCATE TABLE DAILY_SUGGESTION;");
  $AllData = [];
  if ($conn->connect_error)
  {
    die("Connection failed: " . $conn->connect_error);
  }
  if($stmt = mysqli_prepare($conn,"INSERT INTO DAILY_SUGGESTION (INFO, SOURCE) VALUES (?,?);"))
	{
      //echo "TheGuardianParserVIncludu";
    $AllData[] = TheGuardianParser();
    $AllData[] = TheSunParser();
    //$AllData[] = TheSunShowbizzParser();
      /*
				mysqli_stmt_bind_param($stmt,"ss",$vnos,$source);
				mysqli_stmt_execute($stmt);
        */
  }
	else
		echo "Error mysqli_prepare ni deloval!";
	$conn->close();
  var_dump($AllData);
	echo "All parsers finished. The database should be updated.";
?>
