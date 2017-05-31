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

  private function show($slike){
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
              show($slike);
          }else{

              $slike = Image::getXByLikes(1,$steviloDodatnihSlik);
              //dodaj en view za prikaz slike
              show($slike);
            }
        }else{
          $slike = Image::getXByLikes(1,$steviloDodatnihSlik);
          //dodaj en view za prikaz slike
          show($slike);
        }
        $_SESSION['ImageIndex']=1+$steviloDodatnihSlik;
      }
      else{

        if(isset($_GET['sort'])){

          if($_GET['sort']=="new"){

              $slike = Image::getXByDate($_SESSION['ImageIndex'],$steviloDodatnihSlik);

              //view za slike
              show($slike);
          }else{

              $slike = Image::getXByLikes($_SESSION['ImageIndex'],$steviloDodatnihSlik);
              //view za slike

              show($slike);
          }
        }else{
            $slike = Image::getXByLikes($_SESSION['ImageIndex'],$steviloDodatnihSlik);
            //view za slike
            show($slike);
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
            show($slike);
        }else{
            $slike = Image::getXByLikesUser(1,$steviloDodatnihSlik);
            //dodaj en view za prikaz slike
            show($slike);
          }
      }else{
        $slike = Image::getXByDateUser(1,$steviloDodatnihSlik);
        //dodaj en view za prikaz slike
        show($slike);
      }
      $_SESSION['ImageIndex']=1+$steviloDodatnihSlik;
    }
    else{
      if(isset($_GET['sort'])){
        if($_GET['sort']=="new"){
            $slike = Image::getXByDateUser($_SESSION['ImageIndex'],$steviloDodatnihSlik);
            //view za slike
            show($slike);
        }else{
            $slike = Image::getXByLikesUser($_SESSION['ImageIndex'],$steviloDodatnihSlik);
            //view za slike
            show($slike);
        }
      }else{
          $slike = Image::getXByDateUser($_SESSION['ImageIndex'],$steviloDodatnihSlik);
          //view za slike
          show($slike);
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
      "CONTENT"=>'data:image/png;base64,'.$slika->CONTENT,
      "DATEOFUPLOAD"=>$slika->DATEOFUPLOAD,
      "ID_USER"=>$slika->ID_USER,
      "ID_SUGGESTION"=>$slika->ID_SUGGESTION,
      "NSFW"=>$slika->NSFW
    );
      $list[] = $l;
    }
    return $list;
  }

  public static function browseAPI($request,$input){

      //če je kategorija označena
      //if(isset($_GET['category'])){}
      if (!isset($request[1]) || !isset($request[2]) || !isset($request[3]) )
        return call('pages', 'errorAPI');

      if($request[1]=="new"){
          $slike = Image::getXByDate($request[2],$request[3]);
          //dodaj en view za prikaz slike
          $slike = images_controller::changeToJson($slike);
          require_once("views/images/json.php");
      }else{
          $slike = Image::getXByLikes($request[2],$request[3]);
          //dodaj en view za prikaz slike
          $slike = images_controller::changeToJson($slike);
          require_once("views/images/json.php");
      }
  }

  public function getAPI($request,$input){
    images_controller::browseAPI($request,$input);
  }
  public function saveAPI($request,$input){


  }



}

?>
