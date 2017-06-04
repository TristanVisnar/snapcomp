<?php 
	$db = Db::getInstance();
	if ($stmt = mysqli_prepare($db, "SELECT COUNT(ID) as CNT FROM (SELECT ID, ( 3959 * acos( cos( radians(?) ) * cos( radians( LATITUDE ) ) * cos( radians( LONGITUDE ) - radians(?) ) + sin( radians(?) ) * sin( radians( LATITUDE ) ) ) ) AS distance FROM PICTURE HAVING distance < 25 ORDER BY distance);")) {
	for($latitude = 0; $latitude < 90; $latitude++)
	{
		for($longitude = 180; $longitude < -180; $longitude++)
		{
		
		//echo "SUGGESTION INFO: ". $suggestion_info;
			mysqli_stmt_bind_param($stmt, "iii",$latitude, $longitude, $latitude);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			while($row = mysqli_fetch_assoc($result)){
				$groups[] = array("LAT"=>$latitude,"LONG"=>$longitude,"COUNT"=>$row["CNT"]);
			}
		}
	}
	
	var_dump($groups);
}

?>
