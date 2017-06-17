<?php
	include('../../parser/pharse/pharse.php');
	//include 'RedditRandomParser.php';
	include 'TheGuardianParser.php';
	include 'TheSunParser.php';
	include 'TheSunShowbizParser.php';
	include 'PasvAgrsvNotesParser.php';

	$servername = "localhost";
	$username = "user";
    $password = "joomladb";
	$dbname = "snapcomp";
	$conn = new mysqli($servername, $username, $password, $dbname);
	$conn->query("TRUNCATE TABLE DAILY_SUGGESTION;");
	$AllData = [];
	$result = array_merge($AllData, GuardianFunkcija());
	$result = array_merge($result, ShowbizzFunkcija());
	$result = array_merge($result, SunFunkcija());
	$result = array_merge($result, PSNParser());
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}
	if($stmt = mysqli_prepare($conn,"INSERT INTO DAILY_SUGGESTION (INFO, SOURCE) VALUES (?,?);"))
	{
		foreach($result as $entry){
			$vnos = $entry["INFO"];
			$source = $entry["SOURCE"];
			mysqli_stmt_bind_param($stmt,"ss",$vnos,$source);
			mysqli_stmt_execute($stmt);
		}

	}
	echo "All parsers finished. The database should be updated.";
?>
