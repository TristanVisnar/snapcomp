<?php

class rooms_controllers{

	public function sessionData($request,$input){
		$info = Room::sessions($request[2], $request[3]);
		var_dump($info);
	}
	
	public function getAPI($request,$input){
		if($request[1]=="0"){
			sessionData($request,$input);
		}
	}

};


 ?>
