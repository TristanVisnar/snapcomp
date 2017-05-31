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
    //input ma: sliko(CONTENT), USER_ID(), SESSION_ID()
    $db = Db::getInstance();

    if ($stmt = mysqli_prepare($db, "INSERT into  PICTURE(ID_USER,ID_SESSION,CONTENT) values(?,?,?);")) {
      mysqli_stmt_bind_param($stmt, "iib",$input->USER_ID,$input->SESSION_ID,$input->CONTENT);
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
  public function saveEndofsessionPicture($session_id,$picture_id){

    $db = Db::getInstance();

    //NASTAVITVE ZA ZMAGOVALNO SLIKO
    //Bere podatke zmagovalne slike
    if ($stmt = mysqli_prepare($db, "SELECT ID_USER, FROM PICTURE, where ID_SESSION=? and ID=? ;")) {
      mysqli_stmt_bind_param($stmt, "ii",$session_id,$picture_id);
      //izvedemo poizvedbo
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      mysqli_stmt_close($stmt);
      $row = mysqli_fetch_assoc($result);


      if ($stmt2 = mysqli_prepare($db, "INSERT INTO ENDOFSESSION(ID_WINNER,ID_SELECTOR,ID_WINNING_PIC,ID_ROOM) VALUES ();" )) {
        mysqli_stmt_bind_param($stmt2, "ii",$session_id,$picture_id);
        //izvedemo poizvedbo
        mysqli_stmt_execute($stmt2);
        $result2 = mysqli_stmt_get_result($stmt2);
        mysqli_stmt_close($stmt2);

        $row2 = mysqli_fetch_assoc($result2);




      }

    }



  }



}





 ?>
