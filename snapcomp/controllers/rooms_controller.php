<?php

class rooms_controller{

	public function getAllRooms($request,$input){
		$res = Room::all($request[2],$request[3],$request[4]);
		return $res;
	}

	public function sessionData($request,$input){
		$info = Room::sessions($request[2], $request[3]);
		var_dump($info);
	}

	public function getAPI($request,$input){
		if($request[1]=="0"){
			echo "prehajam v sessions"
			rooms_controller::sessionData($request,$input);
		}
		elseif($request[1]=="1"){
			$rooms = rooms_controller::getAllRooms($request,$input);
			require_once("views/rooms/json.php");
		}
	}

};


 ?>
