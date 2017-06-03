<?php

class suggestions_controller{


    public function getDailySuggestions(){
		$out = Suggestion::getDailySuggestions();
		header('Content-Type: application/json');
		echo json_encode($out);
	}	
	public function insertIntoPermaSuggestion($request,$input){
		$out = Suggestion::insertPermaSuggestion($request[2],$request[3],$request[4]);
		//echo $out;
	}


    public function getAPI($request,$input){
		if($request[1]=="dailySuggestions"){
			suggestions_controller::getDailySuggestions();
		}
		elseif($request[1]=="insertSuggestion"){
			suggestions_controller::insertIntoPermaSuggestion($request,$input);
		}
    }
}



?>
