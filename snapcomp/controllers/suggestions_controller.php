<?php

class suggestions_controller{


    public function getDalySuggestions(){
		$out = Suggestion::getDailySuggestions();
		header('Content-Type: application/json');
		echo json_encode($out);
	}	




    public function getAPI($request,$input){
		if($request[1]=="dailySuggestions"){
			suggestions_controller::getDailySuggestions();
		}
		elseif($request[1]=="insertSuggestion"){
			
		}
    }
}



?>
