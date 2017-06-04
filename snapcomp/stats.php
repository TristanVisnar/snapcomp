<?php 

require_once("./connection.php");

function HaversineFormula()
{
	$db = Db::getInstance();
	if ($stmt = mysqli_prepare($db, "SELECT COUNT(ID) as CNT FROM (SELECT ID, ( 3959 * acos( cos( radians(?) ) * cos( radians( LATITUDE ) ) * cos( radians( LONGITUDE ) - radians(?) ) + sin( radians(?) ) * sin( radians( LATITUDE ) ) ) ) AS distance FROM PICTURE HAVING distance < 1005, LIMIT 0 , 20) as res order by cnt;"))
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
					$groups[] = array("LAT"=>$latitude,"LONG"=>$longitude,"COUNT"=>$row["CNT"]);
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

echo "Haversin: \n";
echo HaversineFormula();
echo "<br>";
echo "Best Source: \n";
echo BestSource();


?>
