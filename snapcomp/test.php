<?php

/*
if(class_exist('PDO'))echo "yeah";

require("connection.php");
echo "1";
//PDO:

$pdo = Pdo::getInstance();

$stmt = $pdo->query("Select * From UPORABNIK;");

$row = $stmt->fetch();
var_dump($row);


*/
//mySQLi:

require("connection.php");
$db = Db::getInstance();


$ac = "JANEZACC";
$pass = "JANEZPASS";


if($stmt = mysqli_prepare($db,"Select * from UPORABNIK where ACCNAME=? and PASS=?;")){
 var_dump($stmt);
 echo "2 ...  <br/>";
 mysqli_stmt_bind_param($stmt,"ss",$ac,$pass);
 var_dump($stmt);
 echo "3 ... check <br/>";
 mysqli_stmt_execute($stmt);
 var_dump($stmt);
 echo "4 ... check <br/>";
 $res = mysqli_stmt_get_result($stmt);
 var_dump($res);

 $r = mysqli_fetch_assoc($res);

 var_dump($r);

 mysqli_stmt_close($stmt);
}else{
 echo "Error!  ";
}

?>
