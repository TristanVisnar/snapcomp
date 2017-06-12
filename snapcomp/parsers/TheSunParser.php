<?php
//include('../../parser/pharse/pharse.php');
function SunFunkcija(){
	//include('../../parser/pharse/pharse.php');
	//echo "The Sun parser__________________________________________________________:  <br>";
	$html = Pharse::file_get_dom('https://www.thesun.co.uk/');
	// Find all the paragraph tags with a class attribute and print the
// value of the class attribut
	$source = "thesun.co.uk";
	foreach($html('h2[class="teaser__headline theme__copy-color"]') as $element) {
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
	//svar_dump($new_arr);
	return $new_arr;
}
//var_dump(TheSunParser());
?>
