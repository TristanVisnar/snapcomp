<?php
	include('../../parser/pharse/pharse.php');
	echo "TheGuardian Parser <br>";
	$html = Pharse::file_get_dom('https://www.theguardian.com/international');
	// Find all the paragraph tags with a class attribute and print the
// value of the class attribute
	foreach($html('span[class="fc-item__kicker"]') as $element) {
		$vnos = $element->getPlainText();
		$source = "theguardian.com";
		str_ireplace(' news', '', $vnos);
		str_ireplace(' news ', '', $vnos);
		if(str_word_count($vnos)>4){
			$first4words = implode(' ', array_slice(str_word_count($vnos,1), 0, 4));
			$vnos = $first4words;
			$vnos = $vnos . " ...";
		}
		//var_dump($vnos);
		$exitArray[] = array("INFO" => $vnos, "SOURCE" => $source);
	}
	//var_dump($exitArray);

	foreach($exitArray as $vns){
	//	echo '<pre>' . var_export($vns, true) . '</pre>';
		//var_dump($vns);
	 	echo $vns["INFO"]."//".$vns["SOURCE"]."<br>";
	}
	//echo '<pre>' . var_export($exitArray, true) . '</pre>';
	echo "Pharser konec";
?>
