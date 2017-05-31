<?php

class rooms_controller{

	//http://164.8.230.124/tmp/snapcomp/api.php/rooms/1/:private(0/1)/:nsfw(0/1)/sortDateOrName(0/1)/
	public function getAllRooms($request,$input){
		$res = Room::all($request[2],$request[3],$request[4]);
		return $res;
	}

	public function sessionData($request,$input){
		$info = Room::sessions($request[2], $request[3]);
		echo json_encode($info);
		
	}
	
	public function leaveSession($request,$input){
		//Izpise iz seje z idjem $request[2] uporabnika z idjem $request[3]
		Room::leaveSession($request[2], $request[3]);
		echo "True";
	}

	public function getAPI($request,$input){
		//echo "Dostop do apija";
		//Vnos uporabnika v sejo oz sobo, ter vračanje podatkov o seji
		if($request[1]=="0"){
			//echo "prehajam v sessions";
			rooms_controller::sessionData($request,$input);
		}
		//Vračanje vseh tekočih sob
		elseif($request[1]=="1"){
			$rooms = rooms_controller::getAllRooms($request,$input);
			require_once("views/rooms/json.php");
		}
		elseif($request[1]=="2"){
			rooms_controller::leaveSession($request,$input);
		}
	}

};


 ?>
