<?php

class Timer{

  public function getDateOfStart($session_id){
    $db = Db::getInstance();

    if ($stmt = mysqli_prepare($db, "SELECT TIME_TO_SEC(TIMEDIFF(NOW(),ses.DATEOFSTART)) as TIMEGOING ,r.GAMESTATE FROM SESSION as ses, ROOM as r where ses.ID_ROOM=r.ID and ses.ID=? ;")) {
      mysqli_stmt_bind_param($stmt, "i",$session_id);
      //izvedemo poizvedbo
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      mysqli_stmt_close($stmt);
      if($row = mysqli_fetch_assoc($result)){
         return array("GAMESTATE"=>$row["GAMESTATE"], "TIMEGOING"=>$row["TIMEGOING"]);
      }
      return "error: session does not exist";
    }
    return "error: database error";

  }


  public function setTime($session_id){
    $db = Db::getInstance();

    if($stmt = mysqli_prepare($db,"UPDATE SESSION set DATEOFSTART=NOW() where ID=?")){
      mysqli_stmt_bind_param($stmt, "i",$session_id);
      //izvedemo poizvedbo
      mysqli_stmt_execute($stmt);
      //return "{\"status\": \"OK\"}";
      return Timer::getDateOfStart($session_id);
    }
    return "error: database error";
    //return "{\"status\": \"error\"}";
  }


  public function endOfTakingPics($session_id){
    $db = Db::getInstance();

    if ($stmt = mysqli_prepare($db, "SELECT TIME_TO_SEC(TIMEDIFF(NOW(),ses.DATEOFSTART)) as TIMEGOING ,r.GAMESTATE , ses.SESSION_DURATION FROM SESSION as ses, ROOM as r where ses.ID_ROOM=r.ID and ses.ID=? ;")) {
      mysqli_stmt_bind_param($stmt, "i",$session_id);
      //izvedemo poizvedbo
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      mysqli_stmt_close($stmt);
      if($row = mysqli_fetch_assoc($result)){
         return array("GAMESTATE"=>$row["GAMESTATE"], "TIMEGOING"=>$row["TIMEGOING"]);
      }
      return "error: session does not exist";
    }
    return "error: database error";

  }





}
 ?>
