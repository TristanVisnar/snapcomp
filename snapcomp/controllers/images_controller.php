<?php

/*
Funkcije:
  - browse   - izvede se na domači strani, na kateri prikazuje vse slike
  - user    - izvede se na uporabnikovi strani, da prikaže uporabnikove slike
  - like    - like picture
  - dislike  - dislike picture
*/


class images_controller{

  public function prikaziSliko(){
    if(isset($_GET["ID"])){
      $slike = Image::getByID($_GET["ID"]);
      require_once("views/images/browse_start.php");
      foreach ($slike as $slika) {
        require("views/images/index.php");
      }
      require_once("views/images/browse_end.php");

    }
  }

  public function show($slike){
    require_once("views/pages/browse.php");
    require_once("views/images/browse_start.php");
    foreach ($slike as $slika) {
      echo "it is in";
      require("views/images/index.php");
      echo "it is out";
    }
    echo "it is here";
    require_once("views/images/browse_end.php");
  }

  // prikaze slike iz domace strani
  // vhod $_
  public function browse(){

      $steviloDodatnihSlik = 15;

      //če je kategorija označena
      //if(isset($_GET['category'])){}
      if(!isset($_SESSION['ImageIndex'])){

        if(isset($_GET['sort'])){

          if($_GET['sort']=="new"){
              $slike = Image::getXByDate(1,$steviloDodatnihSlik);
              //dodaj en view za prikaz slike
              images_controller::show($slike);
          }else{

              $slike = Image::getXByLikes(1,$steviloDodatnihSlik);
              //dodaj en view za prikaz slike
              images_controller::show($slike);
            }
        }else{
          $slike = Image::getXByLikes(1,$steviloDodatnihSlik);
          //dodaj en view za prikaz slike
          images_controller::show($slike);
        }
        $_SESSION['ImageIndex']=1+$steviloDodatnihSlik;
      }
      else{

        if(isset($_GET['sort'])){

          if($_GET['sort']=="new"){

              $slike = Image::getXByDate($_SESSION['ImageIndex'],$steviloDodatnihSlik);

              //view za slike
              images_controller::show($slike);
          }else{

              $slike = Image::getXByLikes($_SESSION['ImageIndex'],$steviloDodatnihSlik);
              //view za slike

              images_controller::show($slike);
          }
        }else{
            $slike = Image::getXByLikes($_SESSION['ImageIndex'],$steviloDodatnihSlik);
            //view za slike
            images_controller::show($slike);
        }
        $_SESSION['ImageIndex']=$_SESSION['ImageIndex']+$steviloDodatnihSlik;
      }
  }

  // prikaze slike uporabnika
  public function user(){


    $steviloDodatnihSlik = 15;

    //če je kategorija označena
    //if(isset($_GET['category'])){}
    if(!isset($_SESSION['ImageIndex'])){
      if(isset($_GET['sort'])){
        if($_GET['sort']=="new"){
            $slike = Image::getXByDateUser(1,$steviloDodatnihSlik);
            //dodaj en view za prikaz slike
            images_controller::show($slike);
        }else{
            $slike = Image::getXByLikesUser(1,$steviloDodatnihSlik);
            //dodaj en view za prikaz slike
            images_controller::show($slike);
          }
      }else{
        $slike = Image::getXByDateUser(1,$steviloDodatnihSlik);
        //dodaj en view za prikaz slike
        images_controller::show($slike);
      }
      $_SESSION['ImageIndex']=1+$steviloDodatnihSlik;
    }
    else{
      if(isset($_GET['sort'])){
        if($_GET['sort']=="new"){
            $slike = Image::getXByDateUser($_SESSION['ImageIndex'],$steviloDodatnihSlik);
            //view za slike
            images_controller::show($slike);
        }else{
            $slike = Image::getXByLikesUser($_SESSION['ImageIndex'],$steviloDodatnihSlik);
            //view za slike
            images_controller::show($slike);
        }
      }else{
          $slike = Image::getXByDateUser($_SESSION['ImageIndex'],$steviloDodatnihSlik);
          //view za slike
          images_controller::show($slike);
      }
      $_SESSION['ImageIndex']=$_SESSION['ImageIndex']+$steviloDodatnihSlik;
    }
  }


  public function like(){


  }

  public function dislike(){

  }

  public static function changeToJson($slike){
    $list = [];

    foreach ($slike as $slika) {
      $l = array(
      "ID"=>$slika->ID,
      "DISCRIPTION"=>$slika->DISCRIPTION,
      "CONTENT"=>''.base64_encode($slika->CONTENT),
      "DATEOFUPLOAD"=>$slika->DATEOFUPLOAD,
      "ID_USER"=>$slika->ID_USER,
      "ID_SUGGESTION"=>$slika->ID_SUGGESTION,
      "NSFW"=>$slika->NSFW
    );
      $list[] = $l;
    }
    return $list;
  }


  //164.8.230.124/tmp/snapcomp/api.php/images/0/("new"/"top")/nsfw(0/1)/("odId")/("štSlik")/
  public static function browseAPI($request,$input){
      //če je kategorija označena
      //if(isset($_GET['category'])){}
      if (!isset($request[2]) || !isset($request[3]) || !isset($request[4]) || !isset($request[5]) )
        return call('pages', 'errorAPI');

      $slike = Image::getXImages($request[4],$request[5],$requst[2],$request[3]);
      //dodaj en view za prikaz slike
      //$slike = images_controller::changeToJson($slike);
      echo json_encode($slike);
      //require_once("views/images/json.php");
  }

  // http://164.8.230.124/tmp/snapcomp/api.php/images/1/:ID_SESSION(number)/
  public function getSelectionStatePictures($request,$input){
      $slike = Image::getSessionPictures($request[2]);
      require_once("views/images/json.php");
  }

  public function getAPI($request,$input){
    echo "controller check \n";
    //Podatki za prikaz n slik za browse
    if($request[1] == "0"){
        echo "in api req[1] \n";
        images_controller::browseAPI($request,$input);
    }
    //Podatki in slike za stanje izbire
    elseif($request[1] == "1"){
        images_controller::getSelectionStatePictures($request,$input);
    }

  }

  //POTREBNO TESTIRANJA
  public function savePicture($request,$input){
      Image::savePicture($input);
  }

  //POTREBNO TESTIRANJA
  // input(session_id,picture_id)
  public function saveEndofsessionPicture($request,$input){
      $slike = Image::saveEndofsessionPicture($input->ID_SESSION,$input->ID_PICTURE);
      require_once("views/images/json.php");
  }


  public function postAPI($request,$input){
    //Saving picture SESSION
    if($request[1]=="0"){
      images_controller::savePicture($request,$input);
      }
    //Save picture for ENDOFSESSION
    elseif($request[1]=="1"){
      images_controller::saveEndofsessionPicture($request,$input);
    }

  }


  public function deleteAPI($request,$input){
    //BOMO ŠE VIDLI ČE RABIMO
  }


}

?>
