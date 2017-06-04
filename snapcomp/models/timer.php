<?php

class Timer{

  public function getDateOfStart($session_id){
    echo "in date of start";
    $db = Db::getInstance();

    if ($stmt = mysqli_prepare($db, "SELECT ses.DATEOFSTART,r.GAME_STATE,NOW() as NOW FROM SESSION as ses and ROOM as r where ses.ID_ROOM=r.ID and ses.ID=? ;")) {
      mysqli_stmt_bind_param($stmt, "i",$session_id);
      //izvedemo poizvedbo
      mysqli_stmt_execute($stmt);
      echo "kaoc sas dasad";
      $result = mysqli_stmt_get_result($stmt);
      mysqli_stmt_close($stmt);
      if($row = mysqli_fetch_assoc($result)){
        echo "row get";
         return array("DATEOFSTART"=>$row["DATEOFSTART"],"GAME_STATE"=>$row["GAME_STATE"],"NOW"=>$row["NOW"]);
      }
      return "error: does not exist";
    }
    return "error: not prepared";

  }


}


 ?>
