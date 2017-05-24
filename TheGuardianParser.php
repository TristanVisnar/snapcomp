<?php 

	$html = file_get_html("https://www.theguardian.com/international");
	if(function_exists(file_get_html)){
		echo "true";
	}
	$ret = $html->find('span[class=fc-item__kicker]'); 
	$text = $ret->plaintext; 
	var_dump($ret);
	var_dump($text);
?>