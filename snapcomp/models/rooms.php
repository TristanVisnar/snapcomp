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
      if ($stmt = mysqli_prepare($db, "SELECT * FROM ROOM where NSFW=? order by ? desc")) {
        mysqli_stmt_bind_param($stmt, "iis",intval($private),intval($nsfw),$sort);
        //izvedemo poizvedbo
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        while($row = mysqli_fetch_assoc($result)){
           $list[] = array("ID"=>$row["ID"],"NAME"=>$row["NAME"],"PASSWORD"=>$row["PASSWORD"],"PRIVATEROOM"=>$row["PRIVATEROOM"],"NSFW"=>$row["NSFW"],"DATEOFCREATION"=>$row["DATEOFCREATION"],"ID_CREATOR"=>$row["ID_CREATOR"],"ID_SESSION"=>$row["ID_SESSION"]);
        }
       mysqli_stmt_close($stmt);
       return $list;
     }
    }
}

 ?>
