<?php



class Suggestion{


  public function getDalySuggestions(){
    $db = Db::getInstance();
    $result = mysqli_query($db,"SELECT * FROM DAILY_SUGGESTION;");
    $list = [];
    while($row = mysqli_fetch_assoc($result)){
       $list[] = array("ID" => $row['ID'], "INFO" => $row['INFO'],"SOURCE"=>$row['SOURCE']);
    }
    return $list;
  }

}

 ?>
