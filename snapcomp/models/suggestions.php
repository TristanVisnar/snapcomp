<?php



class Suggestion{


	public function getDailySuggestions(){
		$db = Db::getInstance();
		$result = mysqli_query($db,"SELECT * FROM DAILY_SUGGESTION;");
		$list = [];
		while($row = mysqli_fetch_assoc($result)){
			$list[] = array("ID" => $row['ID'], "INFO" => $row['INFO'],"SOURCE"=>$row['SOURCE']);
		}
		return $list;
	}
	
	public function insertPermaSuggestion($info,$userOrSuggestion,$id_uploader){
		//je user
		$db = Db::getInstance();	
		$addedInfo = [];
		
		if($userOrSuggestion == "0"){
			if ($stmt = mysqli_prepare($db, "Select USERNAME from UPORABNIK where ID = ?")) {
				mysqli_stmt_bind_param($stmt, "i",intval($id_uploader));
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);
				$row = mysqli_fetch_assoc($result);
				$uploader = $row["USERNAME"];
				
			}
			mysqli_stmt_close($stmt);
		}
		elseif($userOrSuggestion == "1"){
			if ($stmt = mysqli_prepare($db, "Select SOURCE from DAILY_SUGGESTION where ID = ?")) {
				mysqli_stmt_bind_param($stmt, "i",intval($id_uploader));
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);
				$row = mysqli_fetch_assoc($result);
				$uploader = $row["SOURCE"];
			}
			mysqli_stmt_close($stmt);
		}
		else $uploader = "NULL";
		
		$addedInfo["UPLOADER"] = $uploader;
		$addedInfo["INFO"] = $info;
 		if ($stmt = mysqli_prepare($db, "INSERT INTO SUGGESTION (INFO, SOURCE) VALUES (?,?)")) {
				mysqli_stmt_bind_param($stmt, "ss",$info,$uploader);
				mysqli_stmt_execute($stmt);
				$last_id = mysqli_insert_id($db);
		}
		$addedInfo["ID"] = $last_id;
		mysqli_stmt_close($stmt);
		echo json_encode($addedInfo);
	}

}

 ?>
