<?php

class rooms_controller{
	//TE FUNCIJE SE KLICEJO
	//http://164.8.230.124/tmp/snapcomp/api.php/rooms/1/:private(0/1)/:nsfw(0/1)/sortDateOrName(0/1)/
	public function getAllRooms($request,$input){
		$res = Room::all($request[2],$request[3],$request[4]);
		return $res;
	}

	//http://164.8.230.124/tmp/snapcomp/api.php/rooms/sessionData/:session_id/
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
		return $info;
	}
	public function updateSessionTheme($request, $input){
		$info = Room::updateSessionTheme($request[2],$request[3]);
		echo $info;
	}
	public function createRoom($request, $input){
	//	echo "lista podatkov:";
		//var_dump($input);
		$ret= Room::createRoom($input->NAME,$input->ID_CREATOR,$input->PRIVATEROOM,$input->NSFWROOM,$input->PASSWORD);
		return $ret;
	}
	//$sessionDuration, $id_selectorja, $id_room, $id_suggestion
	public function createSession($request, $input){
		//echo "v controler funkciji";
		$ret = Room::createSession($input->SESSION_DURATION, $input->ID_SELECTOR, $input->ID_ROOM, $input->ID_SUGGESTION);
		return $ret;
	}

	public function updateSession($request,$input){
		$out = Room::updateSession($input->SESSION_DURATION, $input->ID_SELECTOR, $input->ID_ROOM, $input->ID_SUGGESTION);
		echo json_encode($out);
	}

	public function getSessionViaRoomID($request, $input){
		//echo "V KONT FUNK";
		$ret = Room::SessionViaRoomID($request[2],$request[3]);
		header('Content-Type: application/json');
		echo json_encode($ret);
	}

	//in $session_id, $gamemode
	public function changeGamemode($request,$input){
		$info = Room::changeGamemode($request[2],$request[3]);
		echo $info;
	}



	public function getAPI($request,$input){
		//echo "Dostop do apija";
		//Vnos uporabnika v sejo oz sobo, ter vračanje podatkov o seji
		//Vhod ID_SESSION
		if($request[1]=="sessionData"){
			//echo "prehajam v sessions";
			rooms_controller::sessionData($request,$input);
		}
		//Vračanje vseh tekočih sob
		elseif($request[1]=="roomsData"){
			$rooms = rooms_controller::getAllRooms($request,$input);
			require_once("views/rooms/json.php");
		}
		elseif($request[1]=="enterSession"){
			$ret = rooms_controller::enterSession($request, $input);
			header('Content-Type: application/json');
			echo json_encode($ret);
		}
		elseif($request[1]=="leaveSession"){
			rooms_controller::leaveSession($request,$input);
		}
		elseif($request[1]=="sessionTheme"){
			rooms_controller::updateSessionTheme($request,$input);
		}
		elseif($request[1]=="sessionViaRoomID"){
			rooms_controller::getSessionViaRoomID($request,$input);
		}
		elseif($request[1]=="changeGamemode"){
			rooms_controller::changeGamemode($request,$input);
		}
	}
	 public function postAPI($request,$input){
        if($request[1]=="createRoom"){
			$id = rooms_controller::createRoom($request,$input);
			header('Content-Type: application/json');
			echo $id;
			//echo json_encode($id);
		}
		if($request[1]=="createSession"){
			$id = rooms_controller::createSession($request,$input);
			header('Content-Type: application/json');
			//echo $id;
			echo json_encode($id);
		}
		if($request[1]=="updateSession"){
			rooms_controller::updateSession($request,$input);
		}

    }

};


 ?>
