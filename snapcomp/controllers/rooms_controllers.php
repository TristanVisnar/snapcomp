<?php

class rooms_controllers{

	public function getAllRooms($request,$input){
		$res = Room::all($request[2],$request[3],$request[4]);
		var_dump($res);
	}

	public function sessionData($request,$input){
		$info = Room::sessions($request[2], $request[3]);
		var_dump($info);
	}

	public function getAPI($request,$input){
		if($request[1]=="0"){
			rooms_controllers::sessionData($request,$input);
		}
		elseif($request[1]=="1"){
			rooms_controllers::getAllRooms($request,$input);
		}
	}

};


 ?>
