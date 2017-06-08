<?php 
	include('../../parser/pharse/pharse.php');
	echo "Yahoo Odd News parser <br>";
	$html = Pharse::file_get_dom('https://www.yahoo.com/news/odd/');
	// Find all the paragraph tags with a class attribute and print the
// value of the class attribute
	$returnList = [];
	foreach($html('span[class="Fw(b) Fz(20px) Lh(23px) LineClamp(2,46px) Fz(17px)--sm1024 Lh(19px)--sm1024 LineClamp(2,38px)--sm1024 Td(n) C(#0078ff):h C(#000)"]') as $element) {
		$vnos = $element->getPlainText(), "<br>\n"; 
		str_ireplace(' news', '', $vnos);
		str_ireplace(' news ', '', $vnos);
		if(str_word_count($vnos)>4){
			$first4words = implode(' ', array_slice(str_word_count($vnos,1), 0, 4));
			$vnos = $first4words;
			$vnos = $vnos . " ...";
		}
		$returnList[] = $vnos;
	}
	
	echo "Pharser konec";
	foreach($returnList as $vns){
		echo $vns."<br>";
	}
	//return $returnList;
?>