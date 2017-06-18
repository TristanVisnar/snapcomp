<?php
	include('../../parser/pharse/pharse.php');
	//function PSNParser()
	//{
		//$list = [];
		for ($x = 2; $x <= 7; $x++)
			{
				$html = Pharse::file_get_dom('http://www.passiveaggressivenotes.com/page/'.$x.'/');
				foreach($html('a[rel="bookmark"]') as $element)
				{
					$vnos = $element->getPlainText();
					$source = "www.passiveaggressivenotes.com";

					if(str_word_count($vnos)>4)
					{
						$first4words = implode(' ', array_slice(str_word_count($vnos,1), 0, 4));
						$vnos = $first4words;
						$vnos = $vnos . " ...";
					}

					$list[] = array("INFO" => $vnos, "SOURCE" => $source);
				}
			}
			$new_arr = array_unique($list, SORT_REGULAR);
			var_dump($new_arr);
			//return $new_arr;
			//echo "passiveaggressivenotes parser finished!<br>";
	//}
?>
