<?php 
	include('../../parser/pharse/pharse.php');
	echo "Reddit random parser<br>";
	
	//https://www.reddit.com/r/random
//https://www.reddit.com/r/wholesomeoverwatch/
		echo "Title: ";
		$html = Pharse::file_get_dom('https://www.reddit.com/r/wholesomeoverwatch/');
		//echo "<!--".$html."-->";
		$naslov = $html("title")->getPlainText();
		echo $naslov . "<br>\n";

	echo "Pharser konec";
?>