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

  public function isThemeSet($request,$input){
    $out = Suggestion::themeIsChoosen($request[2]);
    echo json_encode($out);
  }


    public function getAPI($request,$input){
		if($request[1]=="dailySuggestions"){
			suggestions_controller::getDailySuggestions();
		}
    if($request[1]=="isThemeSet"){
			suggestions_controller::isThemeSet($request,$input);
		}
}

	public function postApi($request,$input){
		if($request[1]=="insertSuggestion"){
			suggestions_controller::insertIntoPermaSuggestion($request,$input);
		}
	}
}



?>
