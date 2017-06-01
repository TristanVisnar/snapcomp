<?php

class rooms_controller{

	//http://164.8.230.124/tmp/snapcomp/api.php/rooms/1/:private(0/1)/:nsfw(0/1)/sortDateOrName(0/1)/
	public function getAllRooms($request,$input){
		$res = Room::all($request[2],$request[3],$request[4]);
		return $res;
	}

	public function sessionData($request,$input){
		$info = Room::returnSessionData($request[2]);
		echo json_encode($info);
	}
	
	public function leaveSession($request,$input){
		//Izpise iz seje z idjem $request[2] uporabnika z idjem $request[3]
		Room::leaveSession($request[2], $request[3]);
		echo "True";
	}
	
	public function enterSession($request, $input){
		//Vpise v sejo idjem $request[2] uporabnika z idjem $request[3]
		$info = Room::addUserToSession($request[2],$request[3]);
		//info so informacije o seji, v katero vstavimo uporabnika
		echo $info;
	}

	public function getAPI($request,$input){
		//echo "Dostop do apija";
		//Vnos uporabnika v sejo oz sobo, ter vračanje podatkov o seji
		if($request[1]=="sessiondData"){
			//echo "prehajam v sessions";
			rooms_controller::sessionData($request,$input);
		}
		//Vračanje vseh tekočih sob
		elseif($request[1]=="roomsData"){
			$rooms = rooms_controller::getAllRooms($request,$input);
			require_once("views/rooms/json.php");
		}
		elseif($request[1]=="enterSession"){
			rooms_controller::enterSession($request, $input);
		}
		elseif($request[1]=="leaveSession"){
			rooms_controller::leaveSession($request,$input);
		}
		
		
	}

};


 ?>
