<?php

class rooms_controller{

	public function getAllRooms($request,$input){
		echo "sem v 2   ";
		$res = Room::all($request[2],$request[3],$request[4]);
		echo "sem vzunaj   ";
		var_dump($res);
		return $res;
	}

	public function sessionData($request,$input){
		$info = Room::sessions($request[2], $request[3]);
		var_dump($info);
	}

	public function getAPI($request,$input){
		echo "sem v appiju   ";
		if($request[1]=="0"){
			rooms_controllers::sessionData($request,$input);
		}
		elseif($request[1]=="1"){
			echo "sem v 1   ";
			$rooms = rooms_controllers::getAllRooms($request,$input);
			require_once("views/rooms/json.php");
		}
	}

};


 ?>
