<?php
	include('../../parser/pharse/pharse.php');
	echo "Yahoo Odd News parser <br>";
	$html = Pharse::file_get_dom('https://www.thesun.co.uk/tvandshowbiz/');
	// Find all the paragraph tags with a class attribute and print the
// value of the class attribute
var_dump($html('h2[class="teaser__headline theme__copy-color"]'));
	foreach($html('h2[class="teaser__headline theme__copy-color"]') as $element) {
		//var_dump($element);

		$vnos = $element->getPlainText();
	//	var_dump($vnos);
//		echo "_____<br>";
	//	$vnos2 = preg_replace("react-text","a",$vnos);
	///	var_dump($vnos2);
		/*str_ireplace(' news', '', $vnos);
		str_ireplace(' news ', '', $vnos);
		str_ireplace('-- react-text --', '', $vnos);
		str_ireplace('--/react-text --', '', $vnos);*/
		if(str_word_count($vnos)>4){
			$first4words = implode(' ', array_slice(str_word_count($vnos,1), 0, 4));
			$vnos = $first4words;
			$vnos = $vnos . " ...";
		}
		echo $vnos."<br>";
		//echo $vnos;
//		$returnList[] = $vnos;
	//}

	echo "Pharser konec";
	//foreach($returnList as $vns){
	//	echo $vns."<br>";
	//}
	//return $returnList;
?>
