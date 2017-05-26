<?php 
	include('../../parser/pharse/pharse.php');
	echo "The Sun parser:  <br>";
	$html = Pharse::file_get_dom('https://www.thesun.co.uk/');
	// Find all the paragraph tags with a class attribute and print the
// value of the class attribute
	foreach($html('h2[class="teaser__headline theme__copy-color"]') as $element) {
		echo $element->getPlainText(), "<br>\n"; 
		
	}
	echo "Parser konec";
?>