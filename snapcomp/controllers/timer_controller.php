<?php

class timer_controller{

  //calling:
  // http://164.8.230.124/tmp/snapcomp/api.php/timer/getStart/ID_SESSION(number)/
  //output:
  // DATEOFSTART, STATE , NOW - server time;
  public function getSessionStart($request,$input){
    $out = Timer::getDateOfStart($request[2]);
    echo json_encode($out);
  }


  // http://164.8.230.124/tmp/snapcomp/api.php/timer/setTime/ID_SESSION(number)/
  public function startTime($request, $require){
    $out = Timer::setTime($request[2]);
    echo json_encode($out);
  }



  // http://164.8.230.124/tmp/snapcomp/api.php/timer/endOTP/ID_SESSION(number)/
  public function endOfTakingPics($request,$input){
    $out = Timer::endOfTakingPics($request[2]);
    echo json_encode($out);
  }


  public function getAPI($request,$input){
    if($request[1]=="getStart"){
      timer_controller::getSessionStart($request,$input);
    }
    elseif($request[1]=="setTime"){
      timer_controller::startTime($request,$input);
    }
    elseif($request[1]=="endOTP"){
      timer_controller::endOfTakingPics($request,$input);
    }
  }








}
?>
