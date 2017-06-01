<?php


////! fix razvrščanje po lajkih


/* Funkcije:
  - getByID   -  dobiš sliko z ID-jem
  - getXByDate - dobiš X slik razvrščene po datumu
  - getXByLikes - dobiš X slik razvrščene po razberju lajkov
  - getXByUserID - dobiš X slik od uporabnika s id-jem
  - getXByDateUser
  - getXByLikesUser
  - like
  - dislike
*/


class Image{

  public $ID;
  public $DISCRIPTION;
  public $CONTENT;
  public $DATEOFUPLOAD;
  public $ID_USER;
  public $ID_SUGGESTION;
  public $LIKES;
  public $DISLIKES;
  public $NSFW;

  public function __construct($ID,$DISCRIPTION,$CONTENT,$DATEOFUPLOAD,$ID_USER,$ID_SUGGESTION,$LIKES,$DISLIKES,$NSFW){
    $this->ID = $ID;
    $this->CONTENT = $CONTENT;
    $this->DATEOFUPLOAD = $DATEOFUPLOAD;
    $this->DISCRIPTION = $DISCRIPTION;
    $this->ID_USER = $ID_USER;
    $this->ID_SUGGESTION = $ID_SUGGESTION;
    $this->LIKES = $LIKES;
    $this->DISLIKES = $DISLIKES;
    $this->NSFW = $NSFW;
  }


  // Image by image ID
  public function getByID($id){
    $id = intval($id);

    $db = Db::getInstance();

    if ($stmt = mysqli_prepare($db, "SELECT * FROM PICTURE where ID=? and ID_SESSION=NULL ")) {
      mysqli_stmt_bind_param($stmt, "i",$id);
      //izvedemo poizvedbo
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      $row = mysql_fetch_assoc($result);


     mysqli_stmt_close($stmt);

     return new Image($row['ID'],$row['DISCRIPTION'],$row['CONTENT'],$row['DATEOFUPLOAD'],$row['ID_USER'],$row['ID_SUGGESTION'],$row['LIKES'],$row['DISLIKES'],$row['NSFW']);
    }
    return "error";
  }



////////////////////////////////////   4 funkcije potrebne POPRAVILA (po delujoči aplikaciji)    /////////////////////////////////////////
  //prikazuje najnovejše
  // getXByDate vrne $x slik od $fromNum-itega elementa, torej:
  //  $x - število slik
  // $fromNum - od katere vrstice v sql tabeli dalje
  public function getXByDate($fromNum,$x){
    $x = intval($x);
    $fromNum = intval($fromNum);

    $db = Db::getInstance();

    $list = [];

    if(isset($_SESSION['NSFW'])){
      if ($stmt = mysqli_prepare($db, "SELECT * FROM PICTURE where NSFW=? and ID_SESSION=NULL order by DATEOFUPLOAD desc limit ?,?")) {
        mysqli_stmt_bind_param($stmt, "iii",$_SESSION['NSFW'],$fromNum,$x);
        //izvedemo poizvedbo
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        while($row = mysqli_fetch_assoc($result)){
           $list[] = new Image($row['ID'],$row['DISCRIPTION'],$row['CONTENT'],$row['DATEOFUPLOAD'],$row['ID_USER'],$row['ID_SUGGESTION'],$row['LIKES'],$row['DISLIKES'],$row['NSFW']);
        }
       mysqli_stmt_close($stmt);

       return $list;
      }
      return "error";

    }else{
      if ($stmt = mysqli_prepare($db, "SELECT * FROM PICTURE where NSFW=0 and ID_SESSION=NULL order by DATEOFUPLOAD desc limit ?,?")) {
        mysqli_stmt_bind_param($stmt, "ii",$fromNum,$x);
        //izvedemo poizvedbo
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        while($row = mysqli_fetch_assoc($result)){
           $list[] = new Image($row['ID'],$row['DISCRIPTION'],$row['CONTENT'],$row['DATEOFUPLOAD'],$row['ID_USER'],$row['ID_SUGGESTION'],$row['LIKES'],$row['DISLIKES'],$row['NSFW']);
        }
       mysqli_stmt_close($stmt);

       return $list;
      }
      return "error";
    }
    return "error";
  }




  // top
  public function getXByLikes($fromNum,$x){
    $x = intval($x);
    $fromNum = intval($fromNum);

    $db = Db::getInstance();

    $list = [];

    if(isset($_SESSION['NSFW'])){
      if ($stmt = mysqli_prepare($db, "SELECT * FROM PICTURE where NSFW=? and ID_SESSION=NULL order by LIKES desc limit ?,?;")) {
        mysqli_stmt_bind_param($stmt, "iii",$_SESSION['NSFW'],$fromNum,$x);
        //izvedemo poizvedbo
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        while($row = mysqli_fetch_assoc($result)){
           $list[] = new Image($row['ID'],$row['DISCRIPTION'],$row['CONTENT'],$row['DATEOFUPLOAD'],$row['ID_USER'],$row['ID_SUGGESTION'],$row['LIKES'],$row['DISLIKES'],$row['NSFW']);
        }
       mysqli_stmt_close($stmt);

       return $list;
      }
      return "error";

    }else{
      if ($stmt = mysqli_prepare($db, "SELECT * FROM PICTURE where NSFW=0 and ID_SESSION=NULL order by LIKES desc limit ?,?;")) {
        mysqli_stmt_bind_param($stmt, "ii",$fromNum,$x);
        //izvedemo poizvedbo
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        while($row = mysqli_fetch_assoc($result)){
           $list[] = new Image($row['ID'],$row['DISCRIPTION'],$row['CONTENT'],$row['DATEOFUPLOAD'],$row['ID_USER'],$row['ID_SUGGESTION'],$row['LIKES'],$row['DISLIKES'],$row['NSFW']);
        }
       mysqli_stmt_close($stmt);

       return $list;
      }
      return "error";
    }
    return "error";
  }





  //prikazuje najnovejše
  // getXByDate vrne $x slik od $fromNum-itega elementa, torej:
  //  $x - število slik
  // $fromNum - od katere vrstice v sql tabeli dalje
  public function getXByDateUser($id,$fromNum,$x){
    $id = intval($id);
    $x = intval($x);
    $fromNum = intval($fromNum);

    $db = Db::getInstance();

    $list = [];

    if(isset($_SESSION['NSFW'])){
      if ($stmt = mysqli_prepare($db, "SELECT * FROM PICTURE where ID_USER=? and NSFW=? and ID_SESSION=NULL order by DATEOFUPLOAD desc limit ?,?")) {
        mysqli_stmt_bind_param($stmt, "iiii",$id,$_SESSION['NSFW'],$fromNum,$x);
        //izvedemo poizvedbo
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        while($row = mysqli_fetch_assoc($result)){
           $list[] = new Image($row['ID'],$row['DISCRIPTION'],$row['CONTENT'],$row['DATEOFUPLOAD'],$row['ID_USER'],$row['ID_SUGGESTION'],$row['LIKES'],$row['DISLIKES'],$row['NSFW']);
        }
       mysqli_stmt_close($stmt);

       return $list;
      }
      return "error";

    }else{
      if ($stmt = mysqli_prepare($db, "SELECT * FROM PICTURE where ID_USER=? and ID_SESSION=NULL and NSFW=0 order by DATEOFUPLOAD desc limit ?,?")) {
        mysqli_stmt_bind_param($stmt, "iii",$id,$fromNum,$x);
        //izvedemo poizvedbo
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        while($row = mysqli_fetch_assoc($result)){
           $list[] = new Image($row['ID'],$row['DISCRIPTION'],$row['CONTENT'],$row['DATEOFUPLOAD'],$row['ID_USER'],$row['ID_SUGGESTION'],$row['LIKES'],$row['DISLIKES'],$row['NSFW']);
        }
       mysqli_stmt_close($stmt);

       return $list;
      }
      return "error";
    }
    return "error";
  }




  // top
  public function getXByLikesUser($id,$fromNum,$x){
    $id = intval($id);
    $x = intval($x);
    $fromNum = intval($fromNum);

    $db = Db::getInstance();

    $list = [];

    if(isset($_SESSION['NSFW'])){
      if ($stmt = mysqli_prepare($db, "SELECT * FROM PICTURE where ID_USER=? and NSFW=? and ID_SESSION=NULL order by LIKES desc limit ?,?")) {
        mysqli_stmt_bind_param($stmt, "iiii",$id,$_SESSION['NSFW'],$fromNum,$x);
        //izvedemo poizvedbo
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        while($row = mysqli_fetch_assoc($result)){
           $list[] = new Image($row['ID'],$row['DISCRIPTION'],$row['CONTENT'],$row['DATEOFUPLOAD'],$row['ID_USER'],$row['ID_SUGGESTION'],$row['LIKES'],$row['DISLIKES'],$row['NSFW']);
        }
       mysqli_stmt_close($stmt);

       return $list;
      }
      return "error";

    }else{
      if ($stmt = mysqli_prepare($db, "SELECT * FROM PICTURE where ID_USER=? and NSFW=0 and ID_SESSION=NULL order by LIKES desc limit ?,?")) {
        mysqli_stmt_bind_param($stmt, "iii",$id,$fromNum,$x);
        //izvedemo poizvedbo
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        while($row = mysqli_fetch_assoc($result)){
           $list[] = new Image($row['ID'],$row['DISCRIPTION'],$row['CONTENT'],$row['DATEOFUPLOAD'],$row['ID_USER'],$row['ID_SUGGESTION'],$row['LIKES'],$row['DISLIKES'],$row['NSFW']);
        }
       mysqli_stmt_close($stmt);

       return $list;
      }
      return "error";
    }
    return "error";
  }

  public function like($id){

    $id = intval($id);

    $db = Db::getInstance();

    if ($stmt = mysqli_prepare($db, "UPDATE PICTURE SET LIKES = LIKES + 1  where ID=? and ID_SESSION=NULL" )) {
      mysqli_stmt_bind_param($stmt, "i",$id);
      //izvedemo poizvedbo
      mysqli_stmt_execute($stmt);
      //$result = mysqli_stmt_get_result($stmt);
     mysqli_stmt_close($stmt);
     return;
     //return new Image($row['ID'],$row['CONTENT'],$row['DATEOFUPLOAD'],$row['DISCRIPTION'],$row['ID_USER']);
    }
    return "error";
  }


  public function dislike($id){

    $id = intval($id);

    $db = Db::getInstance();

    if ($stmt = mysqli_prepare($db, "UPDATE PICTURE SET DISLIKES = DISLIKES + 1  where ID=? and ID_SESSION=NULL")) {
      mysqli_stmt_bind_param($stmt, "i",$id);
      //izvedemo poizvedbo
      mysqli_stmt_execute($stmt);
      //$result = mysqli_stmt_get_result($stmt);
     mysqli_stmt_close($stmt);
     return;
     //return new Image($row['ID'],$row['CONTENT'],$row['DATEOFUPLOAD'],$row['DISCRIPTION'],$row['ID_USER']);
    }
    return "error";
  }



  public function savePicture($input){
    //input ma: sliko(CONTENT), USER ID(), SESSION ID(), SUGGESTION ID, (Optional:) longitude, latitude
    $db = Db::getInstance();

    $long = NULL;
    $lat = NULL;

    if($input->longitude != ""){
      $long = floatval($input->longitude);
    }

    if($input->latitude != ""){
      $lat = floatval($input->latitude);
    }

    if ($stmt = mysqli_prepare($db, "INSERT into  PICTURE(ID_USER,ID_SESSION,CONTENT,ID_SUGGESTION,LATITUDE,LONGITUDE) values(?,?,?,?,?,?);")) {
      mysqli_stmt_bind_param($stmt, "iibidd",$input->ID_USER,$input->ID_SESSION,$input->CONTENT,$input->ID_SUGGESTION,$lat,$long);
      //izvedemo poizvedbo
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
       mysqli_stmt_close($stmt);
       echo "Slika je bila dodana";
       return;
    }
    echo "Napaka";
    return;
  }



  public function getSessionPictures($session_id){

    $db = Db::getInstance();

    if ($stmt = mysqli_prepare($db, "SELECT * FROM PICTURE where ID_SESSION=? order by DATEOFUPLOAD desc ;")) {
      mysqli_stmt_bind_param($stmt, "i",$session_id);
      //izvedemo poizvedbo
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      mysqli_stmt_close($stmt);
      $list = [];
      while($row = mysqli_fetch_assoc($result)){
         $list[] = array("ID"=>$row["ID"],"CONTENT"=>''.base64_encode($row["CONTENT"]),"ID_USER"=>$row["ID_USER"]);
      }
      return $list;
    }
    return "error";
  }




  ////WORKING ON IT/////
  //USTVARI NOVI KONEC SEJE
  public function saveEndofsessionPicture($session_id,$picture_id){

    $db = Db::getInstance();

    $output = array("error"=>"True");

    //NASTAVITVE ZA ZMAGOVALNO SLIKO
    //Bere podatke zmagovalne slike
    $id_novega_endofsessiona = 0;
    if ($stmt = mysqli_prepare($db, "SELECT p.ID_USER as ID_WINNER,s.ID_SELECTOR,p.ID as ID_PICTURE,s.ID_ROOM,s.DATEOFSTART FROM PICTURE as p, SESSION as s where p.ID_SESSION = s.ID and p.ID_SESSION=? and p.ID=? ;")) {
      mysqli_stmt_bind_param($stmt, "ii",$session_id,$picture_id);
      //izvedemo poizvedbo
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      mysqli_stmt_close($stmt);
      $row = mysqli_fetch_assoc($result);

      if(!is_null($row)){
        //VSTAVI nov ENDOFSESSION
        if ($stmt2 = mysqli_prepare($db, "INSERT INTO ENDOFSESSION(ID_WINNER,ID_SELECTOR,ID_WINNING_PIC,ID_ROOM,DATEOFSTART) VALUES (?,?,?,?,?);" )) {
            mysqli_stmt_bind_param($stmt2, "iiiis",intval($row["ID_WINNER"]),intval($row["ID_SELECTOR"]),intval($row["ID_PICTURE"]),intval($row["ID_ROOM"]),$row["DATEOFSTART"]);
            //izvedemo poizvedbo
            mysqli_stmt_execute($stmt2);
            $result2 = mysqli_stmt_get_result($stmt2);
            $id_novega_endofsessiona = mysqli_stmt_insert_id($stmt2); //nevem če funkcija dela
            mysqli_stmt_close($stmt2);
        }
      }
      else{
        return $output;
      }
    }

    //ODSTRANI SLIKE IZ SESSIONA
    if($stmt = mysqli_prepare($db,"UPDATE PICTURE SET ID_SESSION = NULL WHERE ID_SESSION=?;")){
      mysqli_stmt_bind_param($stmt,"i",$session_id);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);
    }


    //VRNE PODATKE ZMAGOVALNE SLIKE
    if($id_novega_endofsessiona != 0 && $id_novega_endofsessiona != NULL){
      if($stmt = mysqli_prepare($db,"SELECT w.USERNAME as WINNER, s.USERNAME as SELECTOR, sug.INFO, p.CONTENT FROM PICTURE as p,ENDOFSESSION as e,UPORABNIK as w,UPORABNIK as s,SUGGESTION as sug WHERE e.ID=? and p.ID=e.ID_WINNING_PIC and e.ID_WINNER = w.ID and e.ID_SELECTOR=s.ID and p.ID_SUGGESTION = sug.ID;")){
        mysqli_stmt_bind_param($stmt,"i",$session_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);

        $row = mysqli_fetch_assoc($result);

        $output = array("WINNER"=>$row["WINNER"],"SELECTOR"=>$row["SELECTOR"],"INFO"=>$row["INFO"],"CONTENT"=>''.base64_encode($row["CONTENT"]));
      }
    }
    return $output;
}



}





 ?>
