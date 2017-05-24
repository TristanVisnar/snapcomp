<?php 
	include('../parser/pharse/pharse.php');
	echo "Pharser zagon <br>";
	$html = Pharse::file_get_dom('https://www.theguardian.com/international');
	// Find all the paragraph tags with a class attribute and print the
// value of the class attribute
	foreach($html('span[class="fc-item__kicker"]') as $element) {
		echo $element->getPlainText(), "<br>\n"; 
	}
	echo "Pharser konec";
?>