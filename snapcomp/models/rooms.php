<?php

/* metode
  - all -> prikaže vse metode;
  - make -> doda novo mapo;
*/


class Room{

  public $ID;
  public $NAME;
  public $DATEOFCREATION;
  public $PRIVATEROOM;
  public $NSFW;
  public $PASSWORD;
  public $ID_CREATOR;
  public $ID_SESSION;

    public function __construct($ID,$NAME,$DATEOFCREATION,$PRIVATEROOM,$NSFW,$PASSWORD,$ID_CREATOR,$ID_SESSION){
      $this->ID = $ID ;
      $this->NAME = $NAME;
      $this->DATEOFCREATION = $DATEOFCREATION ;
      $this->PRIVATEROOM = $PRIVATEROOM;
      $this->NSFW =$NSFW ;
      $this->PASSWORD =$PASSWORD ;
      $this->ID_CREATOR =$ID_CREATOR;
      $this->ID_SESSION = $ID_SESSION;
    }
	
	public function numOfUsersInSession($id_session){
		$db = Db::getInstance();
		//Izpise usernamein id za vsakega userja v dodani seji
		if ($stmt3 = mysqli_prepare($db, "SELECT COUNT(*) as numOfUsers FROM USER_IN_SESSION WHERE ID_SESSION = ?")) {
			mysqli_stmt_bind_param($stmt3, "i",intval($id_session));
			mysqli_stmt_execute($stmt3);
			$result3 = mysqli_stmt_get_result($stmt3);
			//Selectane imamo vse userje v nasi seji in gremo skozi njih
			$row3 = mysqli_fetch_assoc($result3);
			return $row3["numOfUsers"];
		}
	}
	
	//private = 0/1 nswf = 0/1 full = 0/1 (vrne sobe z manj kot 10, ali sobe tut z 10) sortbydate = 0, else sort by name
    public function all($private,$nsfw,$dateorname){
		//echo "V allu";
		$db = Db::getInstance();
		$sort="";
		if($dateorname==0){
			$sort="DATEOFCREATION";
		}else{
			$sort="NAME";
		}
		$list = [];
		//SELECT * FROM ROOM as r, SESSION as s where PRIVATEROOM=? and NSFWROOM=? and r.ID = s.ID_SESSION order by ? desc
		if ($stmt = mysqli_prepare($db, "SELECT * FROM ROOM where PRIVATEROOM=? and NSFWROOM=? order by ? desc")) {
			mysqli_stmt_bind_param($stmt, "iis",intval($private),intval($nsfw),$sort);
			//izvedemo poizvedbo
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			while($row = mysqli_fetch_assoc($result)){
				if ($stmt2 = mysqli_prepare($db, "SELECT ID FROM SESSION where ID_ROOM = ?")){
					mysqli_stmt_bind_param($stmt2, "i",$row["ID"]);
					//izvedemo poizvedbo
					mysqli_stmt_execute($stmt2);
					$result2 = mysqli_stmt_get_result($stmt2);
					$row2 = mysqli_fetch_assoc($result2);
					$numOfPlayers = Room::numOfUsersInSession($row2["ID"]);
					$list[] = array("ID"=>$row["ID"],"NAME"=>$row["NAME"],"PASSWORD"=>$row["PASSWORD"],"PRIVATEROOM"=>$row["PRIVATEROOM"],"NSFW"=>$row["NSFWROOM"],"DATEOFCREATION"=>$row["DATEOFCREATION"],"ID_CREATOR"=>$row["ID_CREATOR"], "NumOfPlayers" => $numOfPlayers);
				}
			}
			mysqli_stmt_close($stmt);
			//var_dump($list);
			return $list;
		}	
    }
	//Vračanje podatkov za določeno sobo ( v kater se logina uporabnik)
	
	public function updateSessionTheme($id_session, $suggestion_info){
		$db = Db::getInstance();
		//echo "SUGGESTION INFO: ". $suggestion_info;
		if ($stmt = mysqli_prepare($db, "UPDATE SESSION SET ID_SUGGESTION = (SELECT ID FROM SUGGESTION WHERE INFO = ?) WHERE ID = ?")) {
			mysqli_stmt_bind_param($stmt, "si",$suggestion_info,intval($id_session));
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
		return "Updated row with id ".$id_session." in SESSION with entry ".$suggestion_info;
	}
	
	public function returnSessionData($id_session){
		$db = Db::getInstance();
		$list = [];
		//Izpise usernamein id za vsakega userja v dodani seji
		if ($stmt = mysqli_prepare($db, "SELECT ID_USER FROM USER_IN_SESSION WHERE ID_SESSION = ?")) {
			mysqli_stmt_bind_param($stmt, "i",intval($id_session));
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			//Selectane imamo vse userje v nasi seji in gremo skozi njih
			while($row = mysqli_fetch_assoc($result)){
				//echo "<pre>".var_export($row, true)."</pre>";
				if($stmt2 = mysqli_prepare($db, "SELECT USERNAME, ID FROM UPORABNIK WHERE ID = ?")){
					//Gremo skozi vse userje, ter dobimo njihove podatke
					mysqli_stmt_bind_param($stmt2, "i",intval($row["ID_USER"]));
					mysqli_stmt_execute($stmt2);
					$result2 = mysqli_stmt_get_result($stmt2);
					while($row2 = mysqli_fetch_assoc($result2)){
						$users[] = array("ID_USER" => $row2["ID"], "USERNAME" => $row2["USERNAME"]);
					}
				}
			}
			$list["USERS"] = $users;
		}
		mysqli_stmt_close($stmt);
		//Prikaz teme
		if ($stmt = mysqli_prepare($db, "Select ID_SUGGESTION from SESSION where ID = ?")) {
			mysqli_stmt_bind_param($stmt, "i",intval($id_session));
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			$row = mysqli_fetch_assoc($result);
			if($stmt = mysqli_prepare($db, "Select ID, INFO from SUGGESTION where ID = ?")){
				mysqli_stmt_bind_param($stmt, "i",intval($row["ID_SUGGESTION"]));
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);
				$row = mysqli_fetch_assoc($result);
				$list["ID_THEME"] = $row["ID"];
				$list["THEME"] = $row["INFO"];
			}
			mysqli_stmt_close($stmt);
		}
		//Trajanje seje
		if ($stmt = mysqli_prepare($db, "Select SESSION_DURATION from SESSION where ID = ?")) {
			mysqli_stmt_bind_param($stmt, "i",intval($id_session));
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			while($row = mysqli_fetch_assoc($result)){
				$list["SESSION_DURATION"] = $row["SESSION_DURATION"];
			}
			mysqli_stmt_close($stmt);
		}
		//ID SELEKTORJA
		if ($stmt = mysqli_prepare($db, "Select ID_SELECTOR from SESSION where SESSION.ID = ?")) {
			mysqli_stmt_bind_param($stmt, "i",intval($id_session));
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			$row = mysqli_fetch_assoc($result);
			if ($stmt2 = mysqli_prepare($db, "Select USERNAME from UPORABNIK where ID = ?")) {
				//var_dump($row["ID_SELECTOR"]);
				mysqli_stmt_bind_param($stmt2, "i", $row["ID_SELECTOR"]);
				mysqli_stmt_execute($stmt2);
				$result = mysqli_stmt_get_result($stmt2);
				$row = mysqli_fetch_assoc($result);
				$list["USERNAME_SELECTOR"] = $row["USERNAME"];
			}
			mysqli_stmt_close($stmt);
		}
		//ROOMNAME
		if ($stmt = mysqli_prepare($db, "Select ID_ROOM from SESSION where ID = ?")) {
			mysqli_stmt_bind_param($stmt, "i",intval($id_session));
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			$row = mysqli_fetch_assoc($result);
			$list["ID_ROOM"] = $row["ID_ROOM"];
			if ($stmt2 = mysqli_prepare($db, "Select NAME from ROOM where ID = ?")) {
				mysqli_stmt_bind_param($stmt2, "i", $row["ID_ROOM"]);
				mysqli_stmt_execute($stmt2);
				$result2 = mysqli_stmt_get_result($stmt2);
				$row2 = mysqli_fetch_assoc($result2);
				$list["ROOM_NAME"] = $row2["NAME"];
				mysqli_stmt_close($stmt2);

			}
			mysqli_stmt_close($stmt);
		}
		$list["NumOfPlayers"] = Room::numOfUsersInSession($id_session);
		return $list;
	}
	
	public function createSession($sessionDuration, $id_selectorja, $id_room, $id_suggestion){
		$db = Db::getInstance();
		//Vpis usera v sejo igre
		//echo "v creatu";
		if ($stmt = mysqli_prepare($db, "INSERT INTO SESSION (SESSION_DURATION, ID_SELECTOR, ID_ROOM, ID_SUGGESTION) VALUES (?,?,?,?)")) {
			mysqli_stmt_bind_param($stmt, "iiii",intval($sessionDuration),intval($id_selectorja),intval($id_room),intval($id_suggestion));
			mysqli_stmt_execute($stmt);
			//echo "v iffu";
			$last_id = mysqli_insert_id($db);
			$list['SESSION_ID'] = $last_id; 
			//echo $last_id;
		}	
		mysqli_stmt_close($stmt);
		$list["ROOMINFO"] = Room::returnSessionData($last_id);
		//echo "konec!";
		//var_dump($list);
		return $list;
	}
	
	public function addUserToSession($id_session,$id_user){
		//echo "prisel v sess";
		$db = Db::getInstance();
		//Vpis usera v sejo igre
		if ($stmt = mysqli_prepare($db, "INSERT INTO USER_IN_SESSION (ID_USER, ID_SESSION) VALUES (?,?)")) {
			mysqli_stmt_bind_param($stmt, "ii",intval($id_user),intval($id_session));
			mysqli_stmt_execute($stmt);
			//echo "Uporabnika uspesno dodal v session_user\n";
		}	
		mysqli_stmt_close($stmt);
		$list = Room::returnSessionData($id_session);
		return $list;
		//Izpise usernamein id za vsakega userja v dodani seji
	}
	
	public function leaveSession($id_session,$id_user){
		$db = Db::getInstance();
		//Vpis usera v sejo igre
		if ($stmt = mysqli_prepare($db, "DELETE FROM USER_IN_SESSION WHERE ID_USER = ? AND ID_SESSION = ?")) {
			mysqli_stmt_bind_param($stmt, "ii",intval($id_user),intval($id_session));
			mysqli_stmt_execute($stmt);
			//echo "Uporabnika uspesno dodal v session_user\n";
		}	
		mysqli_stmt_close($stmt);
		echo "Uporabnik je zapustil sobo!";
	}
	public function createRoom($name,$id_creator,$privateRoom,$nsfwRoom,$password){
		$db = Db::getInstance();
		//Vpis usera v sejo igre
		if ($stmt = mysqli_prepare($db, "INSERT INTO ROOM (NAME, ID_CREATOR, PRIVATEROOM, NSFWROOM, PASSWORD) VALUES (?,?,?,?,?)")) {
			mysqli_stmt_bind_param($stmt, "siiis",$name, intval($id_creator),intval($privateRoom),intval($nsfwRoom),$password);
			mysqli_stmt_execute($stmt);
			//echo "Vstavil: INSERT INTO ROOM (NAME, ID_CREATOR, PRIVATEROOM, NSFWROOM, PASSWORD) VALUES (".$name.",".intval($id_creator).",".intval($privateRoom).",".intval($nsfwRoom).",".$password.")";
			//echo "finished";
			$last_id = mysqli_insert_id($db);
			return '{ "ID" : ".$last_id." }';
		}
		else {
			echo "Error MYSQL!";
		}
		mysqli_stmt_close($stmt);
		//echo "Error";
	}
}


 ?>
