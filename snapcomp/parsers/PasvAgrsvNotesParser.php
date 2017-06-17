<?php
	include('../../parser/pharse/pharse.php');
	for ($x = 0; $x <= 5; $x++)
		{
			$html = Pharse::file_get_dom('http://www.passiveaggressivenotes.com/pages/' . $x);
			foreach($html('a[ref="bookmark"]') as $element) {
				$vnos = $element->getPlainText();
				$source = "www.passiveaggressivenotes.com";
				if(str_word_count($vnos)>4){
					$first4words = implode(' ', array_slice(str_word_count($vnos,1), 0, 4));
					$vnos = $first4words;
					$vnos = $vnos . " ...";
				}
				mysqli_stmt_bind_param($stmt,"ss",$vnos,$source);
				mysqli_stmt_execute($stmt);
				//$sql = "INSERT INTO DAILY_SUGGESTION (INFO, SOURCE) VALUES ('".$element->getPlainText()."','RedditRandom')";
				//if ($conn->query($sql) === TRUE) {
				//	echo "Vnos ".$x." uspel!";
				//} else {
				//	echo "Error: " . $sql . "<br>" . $conn->error;
				//}
			}
			if(isset($html)){
				unset($html);
			}

		}
		echo "passiveaggressivenotes parser finished!<br>";

?>
