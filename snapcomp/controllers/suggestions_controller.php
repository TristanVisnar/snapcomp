<?php

class suggestions_controller{


    public function getDalySuggestions(){
      $out = Suggestion::getDalySuggestions();
      header('Content-Type: application/json');
      echo json_encode($out);
    }




    public function getAPI($request,$input){
      echo "sem v apiju";
      suggestions_controller::getDalySuggestions();
    }



}



?>
