<?php 
	include('../../parser/pharse/pharse.php');
	echo "Reddit random parser<br>";
	
	//https://www.reddit.com/r/random
//https://www.reddit.com/r/wholesomeoverwatch/
	for ($x = 0; $x <= 1; $x++) {
		//$html = file_get_contents('https://www.reddit.com/r/random');
		//$context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n')));
		//file_get_contents("http://www.something.com/somepage.html",false,$context);
		$html = file_get_contents("https://www.reddit.com/r/random");
		//echo $x;
		//echo "<!--" .$html. "-->";
		//echo "_________________________________________________________________________________________\n<br>";
		foreach($html('title') as $element) {
			echo "Title [".$x."]:  ". $element->getPlainText(), "<br>\n";
			//file_put_contents("Teme.txt", $Title, FILE_APPEND | LOCK_EX);				
		}
		if(isset($html)){
			unset($html);
		}
	}

	echo "Pharser konec";
?>