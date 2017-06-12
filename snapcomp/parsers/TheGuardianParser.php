<?php
include('../../parser/pharse/pharse.php');
function TheGuardianParser(){
	//include('../../parser/pharse/pharse.php');
	//echo "TheGuardian Parser <br>";
	$html = Pharse::file_get_dom('https://www.theguardian.com/international');
	// Find all the paragraph tags with a class attribute and print the
// value of the class attribute
	$source = "theguardian.com";
	echo "test";
	foreach($html('span[class="fc-item__kicker"]') as $element) {
		$vnos = $element->getPlainText();
		str_ireplace(' news', '', $vnos);
		str_ireplace(' news ', '', $vnos);
		if(str_word_count($vnos)>4){
			$first4words = implode(' ', array_slice(str_word_count($vnos,1), 0, 4));
			$vnos = $first4words;
			$vnos = $vnos . " ...";
		}
		$exitArray[] = array("INFO" => $vnos, "SOURCE" => $source);
	}
	$new_arr = array_unique($exitArray, SORT_REGULAR);
	var_dump($new_arr);
	return $new_arr;
}
var_dump(TheGuardianParser());
//var_dump(TheGuardianParser());
?>
