<?php 
	include('../../parser/pharse/pharse.php');
	echo "TheGuardian Parser <br>";
	$html = Pharse::file_get_dom('https://www.reddit.com/r/random');
	// Find all the paragraph tags with a class attribute and print the
// value of the class attribute
	echo $html;
	echo "Pharser konec";
?>