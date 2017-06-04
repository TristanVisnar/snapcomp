<?php

class timer_controller{

  //calling:
  // http://164.8.230.124/tmp/snapcomp/api.php/timer/getStart/ID_SESSION(number)/
  //output:
  // DATEOFSTART, STATE , NOW - server time;
  public getSessionStart($request,$input){
    echo "In session start";
    $out = Timer::getDateOfStart($request[2]);
    echo json_encode($out);
  }


  public getAPI($request,$input){
    echo "In appi";
    if($request[1]=="getStart"){
      timer_controller::getSessionStart($request,$input);
    }
  }

}


 ?>
