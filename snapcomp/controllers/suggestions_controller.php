<?php

class suggestions_controller{


    public function getDailySuggestions(){
		$out = Suggestion::getDailySuggestions();
		header('Content-Type: application/json');
		echo json_encode($out);
	}	
	public function insertIntoPermaSuggestion($request,$input){
		$out = Suggestion::insertPermaSuggestion($input->INFO,$input->userOrSugg,$input->ID_POSTER);
		//echo $out;
	}


    public function getAPI($request,$input){
		if($request[1]=="dailySuggestions"){
			suggestions_controller::getDailySuggestions();
		}
    }
	public function postApi($request,$input){
		if($request[1]=="insertSuggestion"){
			suggestions_controller::insertIntoPermaSuggestion($request,$input);
		}
	}
}



?>
