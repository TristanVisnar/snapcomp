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

    public function all($private,$nsfw,$dateorname){
      $db = Db::getInstance();
      $sort="";
      if($dateorname==0){
        $sort="DATEOFCREATION";
      }else{
        $sort="NAME";
      }
      $list = [];
      if ($stmt = mysqli_prepare($db, "SELECT * FROM ROOM where PRIVATEROOM=? and NSFWROOM=? order by ? desc")) {
        mysqli_stmt_bind_param($stmt, "iis",intval($private),intval($nsfw),$sort);
        //izvedemo poizvedbo
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        while($row = mysqli_fetch_assoc($result)){
           $list[] = array("ID"=>$row["ID"],"NAME"=>$row["NAME"],"PASSWORD"=>$row["PASSWORD"],"PRIVATEROOM"=>$row["PRIVATEROOM"],"NSFW"=>$row["NSFW"],"DATEOFCREATION"=>$row["DATEOFCREATION"],"ID_CREATOR"=>$row["ID_CREATOR"]);
        }
			mysqli_stmt_close($stmt);
			return $list;
		}
    }
	//Vračanje podatkov za določeno sobo ( v kater se logina uporabnik)
	public function sessions($id_session,$id_user){
		echo "prisel v sess";
		$db = Db::getInstance();
		//Vpis usera v sejo igre
		if ($stmt = mysqli_prepare($db, "INSERT INTO USER_IN_SESSION (ID_USER, ID_SESSION) VALUES (?,?)")) {
			mysqli_stmt_bind_param($stmt, "ii",intval($id_user),intval($id_session));
			mysqli_stmt_execute($stmt);
			echo "Uporabnika uspesno dodal v session_user\n";
		}	
		mysqli_stmt_close($stmt);
		$list = [];
		//Izpise usernamein id za vsakega userja v dodani seji
		if ($stmt = mysqli_prepare($db, "SELECT ID_USER FROM USER_IN_SESSION WHERE ID_SESSION = ?")) {
			mysqli_stmt_bind_param($stmt, "i",intval($id_session));
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			//Selectane imamo vse userje v nasi seji in gremo skozi njih
			while($row = mysqli_fetch_assoc($result)){
				echo "<pre>".var_export($row, true)."</pre>";
				if($stmt2 = mysqli_prepare($db, "SELECT USERNAME, ID FROM UPORABNIK WHERE ID = ?")){
					//Gremo skozi vse userje, ter dobimo njihove podatke
					mysqli_stmt_bind_param($stmt2, "i",intval($row["ID_USER"]));
					mysqli_stmt_execute($stmt2);
					$result2 = mysqli_stmt_get_result($stmt2);
					while($row2 = mysqli_fetch_assoc($result2)){
						$list[] = array("ID_USER" => $row2["ID"], "USERNAME" => $row2["USERNAME"]);
					}
				}
			}
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
				$list[] = array("ID_THEME" => $row["ID"], "THEME" => $row["INFO"]);
			}
			mysqli_stmt_close($stmt);
		}
		//Trajanje seje
		
		if ($stmt = mysqli_prepare($db, "Select SESSION_DURATION from SESSION where ID = ?")) {
			mysqli_stmt_bind_param($stmt, "i",intval($id_session));
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			while($row = mysqli_fetch_assoc($result)){
				$list[] = array("SESSION_DURATION" => $row["SESSION_DURATION"]);
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
				mysqli_stmt_bind_param($stmt2, "i", $row["ID_SELECTOR"]);
				mysqli_stmt_execute($stmt2);
				$result = mysqli_stmt_get_result($stmt);
				$row = mysqli_fetch_assoc($result);
				$list[] = array("USERNAME_SELECTOR" => $row["USERNAME"]);
			}
			mysqli_stmt_close($stmt);
		}
		
		//ROOMNAME
		/*
		if ($stmt = mysqli_prepare($db, "Select ID_ROOM from SESSION where SESSION.ID = ?")) {
			mysqli_stmt_bind_param($stmt, "i",intval($id_session));
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			while($row = mysqli_fetch_assoc($result)){
				if ($stmt2 = mysqli_prepare($db, "Select NAME from ROOM where ROOM.ID = ?")) {
					mysqli_stmt_bind_param($stmt2, "i", $row["ID_ROOM"]);
					mysqli_stmt_execute($stmt2);
					$result2 = mysqli_stmt_get_result($stmt2);
					while($row2 = mysqli_fetch_assoc($result2)){
						$list[] = array("ROOM_NAME" => $row2["ID"]);
					}
					mysqli_stmt_close($stmt2);

				}
				mysqli_stmt_close($stmt);

			}

		}*/
		return $list;
	}
}


 ?>
