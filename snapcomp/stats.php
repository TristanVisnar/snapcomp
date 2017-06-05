<?php

require_once("./connection.php");

function HaversineFormula()
{
	$db = Db::getInstance();
	if ($stmt = mysqli_prepare($db, "SELECT COUNT(ID) as CNT FROM (SELECT ID, ( 3959 * acos( cos( radians(?) ) * cos( radians( LATITUDE ) ) * cos( radians( LONGITUDE ) - radians(?) ) + sin( radians(?) ) * sin( radians( LATITUDE ) ) ) ) AS distance FROM PICTURE HAVING distance < 1005) as res order by cnt;"))
	{
		for($latitude = -90; $latitude < 90; $latitude++)
		{
			for($longitude = -180; $longitude < 180; $longitude++)
			{

			//echo "SUGGESTION INFO: ". $suggestion_info;
				mysqli_stmt_bind_param($stmt, "ddd",$latitude, $longitude, $latitude);
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);
				while($row = mysqli_fetch_assoc($result)){
					if($row["CNT"] > 0)
					{
						$groups[] = array("LAT"=>$latitude,"LONG"=>$longitude,"COUNT"=>$row["CNT"]);
					}
				}
			}
		}
	}

	array_multisort(array_column($groups, 'COUNT'), SORT_DESC, $groups);

	var_dump($groups);
}

function bestSource(){
//REATE TEMPORARY TABLE IF NOT EXISTS AS temp (SELECT DISTINCT SOURCE FROM SUGGESTION)"{

	$sql = "SELECT DISTINCT SOURCE from SUGGESTION";
	$db = Db::getInstance();
	if ($stmt = mysqli_prepare($db, $sql))
	{
		//echo "SUGGESTION INFO: ". $suggestion_info;
		mysqli_stmt_bind_param($stmt);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		if ($stmt2 = mysqli_prepare($db, "SELECT COUNT(*) as num FROM SUGGESTION WhERE SOURCE =?"))
		{
			while($row = mysqli_fetch_assoc($result)){
				//0cho "SUGGESTION INFO: ". $suggestion_info;
				mysqli_stmt_bind_param($stmt2, "s",$row["SOURCE"]);
				mysqli_stmt_execute($stmt2);
				$result2 = mysqli_stmt_get_result($stmt2);
				while($row2 = mysqli_fetch_assoc($result2)){
					echo $row2["num"]." : ".$row["SOURCE"]. "\n";
				}
			}
		}
	}
}
/*
function povprecje($likes,$dislikes,$count){
	if($count!=0)
		return ($likes-$dislikes)/$count;
	return 0;
}
*/
function ovrednotiSelectorRating(){

	$list=[];
	$db = Db::getInstance();
	$result1 = mysqli_query($db,"Select ID from UPORABNIK ");
	while($row1 = mysqli_fetch_assoc($result1)){
	/*
	if ($stmt = mysqli_prepare($db, "Select user.ID,user.ACCNAME,SUM(pic.LIKES) as LIKES,SUM(pic.DISLIKES) as DISLIKES,COUNT(*) as ST_SLIK from UPORABNIK as user,ENDOFSESSION as eos,PICTURE as pic where user.ID=eos.ID_SELECTOR and eos.ID_WINNING_PIC=pic.ID and user.ID=?"))
	{
		//echo "SUGGESTION INFO: ". $suggestion_info;
		mysqli_stmt_bind_param($stmt,"i",row["ID"]);
		mysqli_stmt_execute($stmt);
		$result2 = mysqli_stmt_get_result($stmt);

		while($row2 = mysqli_fetch_assoc($result2){
			list[]= array("ID"=>$row["ID"],"ACCNAME"=>$row["ACCNAME"],"LIKES"=>$row["LIKES"],"DISLIKES"=>$row["DISLIKES"],"ST_SLIK"=>$row["ST_SLIK"],"POVPRECJE"=>povprecje($row["LIKES"],$row["DISLIKES"],$row["ST_SLIK"]));
		}
	}
	*/
	if ($stmt = mysqli_prepare($db, "Select user.ID,user.ACCNAME,SUM(pic.LIKES-pic.DISLIKES) as LIKE_DISLIKE from UPORABNIK as user,ENDOFSESSION as eos,PICTURE as pic where user.ID=eos.ID_SELECTOR and eos.ID_WINNING_PIC=pic.ID and user.ID=?"))
	{
		//echo "SUGGESTION INFO: ". $suggestion_info;
		mysqli_stmt_bind_param($stmt,"i",$row1["ID"]);
		mysqli_stmt_execute($stmt);
		$result2 = mysqli_stmt_get_result($stmt);

		while($row2 = mysqli_fetch_assoc($result2)){
			$list[]= array("ID"=>$row2["ID"],"ACCNAME"=>$row2["ACCNAME"],"LIKES_DISLIKES"=>$row2["LIKE_DISLIKE"]);
		}
	}
}

	array_multisort(array_column($list, 'LIKES_DISLIKES'), SORT_DESC, $list);

	return json_encode($list);

}

echo "Haversin: \n";
echo HaversineFormula();
echo "<br>";
echo "Best Source: \n";
echo BestSource();
echo "Ovrednoti selector rating: \n";
echo ovrednotiSelectorRating();


?>
