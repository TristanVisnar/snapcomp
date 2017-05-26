<?php 
	include('../../parser/pharse/pharse.php');
	echo "Reddit random parser<br>";
	
	
	$servername = "localhost";
	$username = "user";
	$password = "joomladb";
	$dbname = "snapcomp";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	//https://www.reddit.com/r/random
	//https://www.reddit.com/r/wholesomeoverwatch/
	for ($x = 0; $x <= 2; $x++) {
		//$html = file_get_contents('https://www.reddit.com/r/random');
		$html = Pharse::file_get_dom('https://www.reddit.com/r/random');
		//echo $x;
		//echo "<!--" .$html. "-->";
		//echo "_________________________________________________________________________________________\n<br>";
		foreach($html('title') as $element) {
			$Tstring = "Title [".$x."]:  ". $element->getPlainText() . "<br>\n";
			$sql = "INSERT INTO SUGGESTION (INFO, SOURCE) VALUES ('".$element->getPlainText()."','RedditRandom')";
			if ($conn->query($sql) === TRUE) {
				echo "Vnos ".$x." uspel!";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
			echo $Tstring;
		}
		if(isset($html)){
			unset($html);
		}
		
	}
	$conn->close();
	echo "Pharser konec";
?>