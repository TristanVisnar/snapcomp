<?php 
	include('../../parser/pharse/pharse.php');
	echo "Reddit random parser<br>";
	
	

		echo "Title: ";
		$html = Pharse::file_get_dom('https://www.reddit.com/r/random');
		echo "<!--".$html."-->";
		//$naslov = $html["title"];
		//echo $naslov . "<br>\n";

	echo "Pharser konec";
?>