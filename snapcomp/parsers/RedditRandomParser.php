<?php 
	include('../../parser/pharse/pharse.php');
	echo "Reddit random parser<br>";
	
	//https://www.reddit.com/r/random
//https://www.reddit.com/r/wholesomeoverwatch/
	for ($x = 0; $x <= 5; $x++) {
		$html = Pharse::file_get_dom('https://www.reddit.com/r/random');
		foreach($html('title') as $element) {
			echo "Title [".$x."]:  ". $element->getPlainText(), "<br>\n"; 
		}	
	}

	echo "Pharser konec";
?>