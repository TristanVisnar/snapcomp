<?php 
	include('../../parser/pharse/pharse.php');
	echo "Reddit random parser<br>";
	
	//https://www.reddit.com/r/random
//https://www.reddit.com/r/wholesomeoverwatch/
	for ($x = 0; $x <= 0; $x++) {
		//$html = file_get_contents('https://www.reddit.com/r/random');
		$html = Pharse::file_get_dom('https://www.reddit.com/r/random');
		//echo $x;
		//echo "<!--" .$html. "-->";
		//echo "_________________________________________________________________________________________\n<br>";
		foreach($html('title') as $element) {
			$Tstring = "Title [".$x."]:  ". $element->getPlainText() . "<br>\n";
			echo $Tstring;
		}
		if(isset($html)){
			unset($html);
		}
	}
	echo "Pharser konec";
?>