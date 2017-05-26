<?php 
	include('../../parser/pharse/pharse.php');
	
	//Konekcija
	$servername = "localhost";
	$username = "user";
	$password = "joomladb";
	$dbname = "snapcomp";
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}
	//Reddit random parser (počasen ko pes)
	for ($x = 0; $x <= 50; $x++) {
		$html = Pharse::file_get_dom('https://www.reddit.com/r/random');
		foreach($html('title') as $element) {
			$sql = "INSERT INTO DAILY_SUGGESTION (INFO, SOURCE) VALUES ('".$element->getPlainText()."','RedditRandom')";
			if ($conn->query($sql) === TRUE) {
				echo "Vnos ".$x." uspel!";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
		if(isset($html)){
			unset($html);
		}
		
	}
	echo "Reddit//random parser finished!";
	//The sun Parser
	$x = 1;
	$html = Pharse::file_get_dom('https://www.thesun.co.uk/');
	foreach($html('h2[class="teaser__headline theme__copy-color"]') as $element) 
	{
		$sql = "INSERT INTO DAILY_SUGGESTION (INFO, SOURCE) VALUES ('".$element->getPlainText()."','thesun.co.uk')";
		if ($conn->query($sql) === TRUE) {
			echo "Vnos ".$x." uspel!";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$x++;
	}
	echo "thesun.co.uk parser finished!";
	//The guardian parser
	$x = 1;
	$html = Pharse::file_get_dom('https://www.theguardian.com/international');
	foreach($html('span[class="fc-item__kicker"]') as $element) 
	{
		$sql = "INSERT INTO DAILY_SUGGESTION (INFO, SOURCE) VALUES ('".$element->getPlainText()."','theguardian.com')";
		if ($conn->query($sql) === TRUE) {
			echo "Vnos ".$x." uspel!";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}		
		$x++;
	}
	echo "theguardian.com parser finished!";
	$conn->close();
	echo "All parsers finished. The database should be updated.";
?>