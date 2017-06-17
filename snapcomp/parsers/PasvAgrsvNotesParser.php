<?php
	include('../../parser/pharse/pharse.php');
	$list = [];
	for ($x = 2; $x <= 7; $x++)
		{

			$html = Pharse::file_get_dom('http://www.passiveaggressivenotes.com/page/'.$x.'/');
			foreach($html('a[ref="bookmark"]') as $element) {
				$vnos = $element->getPlainText();
				$source = "www.passiveaggressivenotes.com";
				if(str_word_count($vnos)>4){
					$first4words = implode(' ', array_slice(str_word_count($vnos,1), 0, 4));
					$vnos = $first4words;
					$vnos = $vnos . " ...";
				}
				$list[] = array("INFO" => $vnos, "SOURCE" => $source);
			}


		}
		var_dump($list);
		echo "passiveaggressivenotes parser finished!<br>";
?>
