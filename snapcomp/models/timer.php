<?php

class Timer{

  public function getDateOfStart($session_id){
    $db = Db::getInstance();

    if ($stmt = mysqli_prepare($db, "SELECT ses.DATEOFSTART,r.GAMESTATE,NOW() as NV FROM SESSION as ses, ROOM as r where ses.ID_ROOM=r.ID and ses.ID=? ;")) {
      mysqli_stmt_bind_param($stmt, "i",$session_id);
      //izvedemo poizvedbo
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      mysqli_stmt_close($stmt);
      if($row = mysqli_fetch_assoc($result)){
         return array("DATEOFSTART"=>$row["DATEOFSTART"],"GAMESTATE"=>$row["GAMESTATE"],"NOW"=>$row["NV"]);
      }
      return "error: does not exist";
    }
    return "error: not prepared";

  }


}


 ?>
