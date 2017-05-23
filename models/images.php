<?php

/* Funkcije:
  - getByID   -  dobiš sliko z ID-jem
  - getXByDate - dobiš X slik razvrščene po datumu
  - getXByUserID - dobiš X slik od uporabnika s id-jem
*/


class Image{

  public $ID;
  public $CONTENT;
  public $DATEOFUPLOAD;
  public $DISCRIPTION;
  public $ID_USER;
  public $LIKES;
  public $DISLIKES;
  public $NSFW;

  public function __construct($$ID,$CONTENT,$DATEOFUPLOAD,$DISCRIPTION,$ID_USER,$LIKES,$DISLIKES,$NSFW){
    $this->ID = $ID;
    $this->CONTENT = $CONTENT;
    $this->DATEOFUPLOAD = $DATEOFUPLOAD;
    $this->DISCRIPTION = $DISCRIPTION;
    $this->ID_USER = $ID_USER;
    $this->LIKES = $LIKES;
    $this->DISLIKES = $DISLIKES;
    $this->NSFW = $NSFW;
  }


  // Image by image ID
  public function getByID($id){
    $id = intval($id);

    if ($stmt = mysqli_prepare($db, "SELECT * FROM PICTURE where id=?")) {
      mysqli_stmt_bind_param($stmt, "i",$id);
      //izvedemo poizvedbo
      $row = mysqli_stmt_execute($stmt);

     mysqli_stmt_close($stmt);

     return new Image($row['ID'],$row['CONTENT'],$row['DATEOFUPLOAD'],$row['DISCRIPTION'],$row['ID_USER']);
    }
    return "error";
  }

  //prikazuje najnovejše
  // getXByDate vrne $x slik od $fromNum-itega elementa, torej:
  //  $x - število slik
  // $fromNum - od katere vrstice v sql tabeli dalje
  public function getXByDate($x,$fromNum){
    $x = intval($x);
    $fromNum = intval($fromNum);

    $list = [];

    if(isset($_SESSION['NSFW'])){
      if ($stmt = mysqli_prepare($db, "SELECT * FROM PICTURE where NSFW=? order by DATEOFUPLOAD desc limit ?,?")) {
        mysqli_stmt_bind_param($stmt, "iii",$_SESSION['NSFW'],$fromNum,$x);
        //izvedemo poizvedbo
        $result = mysqli_stmt_execute($stmt);

        while($row = mysqli_fetch_assoc($result)){
           $list[] = new Image($row['ID'],$row['CONTENT'],$row['DATEOFUPLOAD'],$row['DISCRIPTION'],$row['ID_USER']);
        }
       mysqli_stmt_close($stmt);

       return $list;
      }
      return "error";

    }else{
      if ($stmt = mysqli_prepare($db, "SELECT * FROM PICTURE where NSFW=0 order by DATEOFUPLOAD desc limit ?,?")) {
        mysqli_stmt_bind_param($stmt, "ii",$fromNum,$x);
        //izvedemo poizvedbo
        $result = mysqli_stmt_execute($stmt);

        while($row = mysqli_fetch_assoc($result)){
           $list[] = new Image($row['ID'],$row['CONTENT'],$row['DATEOFUPLOAD'],$row['DISCRIPTION'],$row['ID_USER']);
        }
       mysqli_stmt_close($stmt);

       return $list;
      }
      return "error";
    }
    return "error";
  }




  // top
  public function getXByLikes($x,$fromNum){
    $x = intval($x);
    $fromNum = intval($fromNum);

    $list = [];

    if(isset($_SESSION['NSFW'])){
      if ($stmt = mysqli_prepare($db, "SELECT * FROM PICTURE where NSFW=? order by LIKES desc limit ?,?")) {
        mysqli_stmt_bind_param($stmt, "iii",$_SESSION['NSFW'],$fromNum,$x);
        //izvedemo poizvedbo
        $result = mysqli_stmt_execute($stmt);

        while($row = mysqli_fetch_assoc($result)){
           $list[] = new Image($row['ID'],$row['CONTENT'],$row['DATEOFUPLOAD'],$row['DISCRIPTION'],$row['ID_USER']);
        }
       mysqli_stmt_close($stmt);

       return $list;
      }
      return "error";

    }else{
      if ($stmt = mysqli_prepare($db, "SELECT * FROM PICTURE where NSFW=0 order by LIKES desc limit ?,?")) {
        mysqli_stmt_bind_param($stmt, "ii",$fromNum,$x);
        //izvedemo poizvedbo
        $result = mysqli_stmt_execute($stmt);

        while($row = mysqli_fetch_assoc($result)){
           $list[] = new Image($row['ID'],$row['CONTENT'],$row['DATEOFUPLOAD'],$row['DISCRIPTION'],$row['ID_USER']);
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
  public function getXByDateUser($id,$x,$fromNum){
    $id = intval($id);
    $x = intval($x);
    $fromNum = intval($fromNum);

    $list = [];

    if(isset($_SESSION['NSFW'])){
      if ($stmt = mysqli_prepare($db, "SELECT * FROM PICTURE where ID_USER=? and NSFW=? order by DATEOFUPLOAD desc limit ?,?")) {
        mysqli_stmt_bind_param($stmt, "iiii",$id,$_SESSION['NSFW'],$fromNum,$x);
        //izvedemo poizvedbo
        $result = mysqli_stmt_execute($stmt);

        while($row = mysqli_fetch_assoc($result)){
           $list[] = new Image($row['ID'],$row['CONTENT'],$row['DATEOFUPLOAD'],$row['DISCRIPTION'],$row['ID_USER']);
        }
       mysqli_stmt_close($stmt);

       return $list;
      }
      return "error";

    }else{
      if ($stmt = mysqli_prepare($db, "SELECT * FROM PICTURE where ID_USER=? and NSFW=0 order by DATEOFUPLOAD desc limit ?,?")) {
        mysqli_stmt_bind_param($stmt, "iii",$id,$fromNum,$x);
        //izvedemo poizvedbo
        $result = mysqli_stmt_execute($stmt);

        while($row = mysqli_fetch_assoc($result)){
           $list[] = new Image($row['ID'],$row['CONTENT'],$row['DATEOFUPLOAD'],$row['DISCRIPTION'],$row['ID_USER']);
        }
       mysqli_stmt_close($stmt);

       return $list;
      }
      return "error";
    }
    return "error";
  }




  // top
  public function getXByLikesUser($id,$x,$fromNum){
    $id = intval($id);
    $x = intval($x);
    $fromNum = intval($fromNum);

    $list = [];

    if(isset($_SESSION['NSFW'])){
      if ($stmt = mysqli_prepare($db, "SELECT * FROM PICTURE where ID_USER=? and NSFW=? order by LIKES desc limit ?,?")) {
        mysqli_stmt_bind_param($stmt, "iiii",$id,$_SESSION['NSFW'],$fromNum,$x);
        //izvedemo poizvedbo
        $result = mysqli_stmt_execute($stmt);

        while($row = mysqli_fetch_assoc($result)){
           $list[] = new Image($row['ID'],$row['CONTENT'],$row['DATEOFUPLOAD'],$row['DISCRIPTION'],$row['ID_USER']);
        }
       mysqli_stmt_close($stmt);

       return $list;
      }
      return "error";

    }else{
      if ($stmt = mysqli_prepare($db, "SELECT * FROM PICTURE where ID_USER=? and NSFW=0 order by LIKES desc limit ?,?")) {
        mysqli_stmt_bind_param($stmt, "iii",$id,$fromNum,$x);
        //izvedemo poizvedbo
        $result = mysqli_stmt_execute($stmt);

        while($row = mysqli_fetch_assoc($result)){
           $list[] = new Image($row['ID'],$row['CONTENT'],$row['DATEOFUPLOAD'],$row['DISCRIPTION'],$row['ID_USER']);
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

    if ($stmt = mysqli_prepare($db, "UPDATE PICTURE SET LIKES = LIKES + 1  where id=?")) {
      mysqli_stmt_bind_param($stmt, "i",$id);
      //izvedemo poizvedbo
      $row = mysqli_stmt_execute($stmt);

     mysqli_stmt_close($stmt);
     return;
     //return new Image($row['ID'],$row['CONTENT'],$row['DATEOFUPLOAD'],$row['DISCRIPTION'],$row['ID_USER']);
    }
    return "error";
  }


  public function dislike($id){

    $id = intval($id);

    if ($stmt = mysqli_prepare($db, "UPDATE PICTURE SET DISLIKES = DISLIKES + 1  where id=?")) {
      mysqli_stmt_bind_param($stmt, "i",$id);
      //izvedemo poizvedbo
      $row = mysqli_stmt_execute($stmt);

     mysqli_stmt_close($stmt);
     return;
     //return new Image($row['ID'],$row['CONTENT'],$row['DATEOFUPLOAD'],$row['DISCRIPTION'],$row['ID_USER']);
    }
    return "error";
  }

}



 ?>
