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

  // prikaze slike iz domace strani
  // vhod $_
  public function browse(){

      $steviloDodatnihSlik = 15;

      //če je kategorija označena
      //if(isset($_GET['category'])){}
      if(!isset($_SESSION['ImageIndex'])){
        if(isset($_GET['sort'])){
          if($_GET['sort']=="new"){
              $slike = Image::getXByDate(0,$steviloDodatnihSlik);
              //dodaj en view za prikaz slike
          }else{
              $slike = Image::getXByDate(0,$steviloDodatnihSlik);
              //dodaj en view za prikaz slike
            }
        }else{
          $slike = Image::getXByDate(0,$steviloDodatnihSlik);
          //dodaj en view za prikaz slike
        }
      }
      else{
        if(isset($_GET['sort'])){
          if($_GET['sort']=="new"){
              $slike = Image::getXByDate($_SESSION['ImageIndex'],$steviloDodatnihSlik);
              //view za slike
          }else{
              $slike = Image::getXByLikes($_SESSION['ImageIndex'],$steviloDodatnihSlik);
              //view za slike
          }
        }else{
            $slike = Image::getXByLikes($_SESSION['ImageIndex'],$steviloDodatnihSlik);
            //view za slike
        }
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
            $slike = Image::getXByDateUser(0,$steviloDodatnihSlik);
            //dodaj en view za prikaz slike
        }else{
            $slike = Image::getXByDateUser(0,$steviloDodatnihSlik);
            //dodaj en view za prikaz slike
          }
      }else{
        $slike = Image::getXByDateUser(0,$steviloDodatnihSlik);
        //dodaj en view za prikaz slike
      }
    }
    else{
      if(isset($_GET['sort'])){
        if($_GET['sort']=="new"){
            $slike = Image::getXByDateUser($_SESSION['ImageIndex'],$steviloDodatnihSlik);
            //view za slike
        }else{
            $slike = Image::getXByLikesUser($_SESSION['ImageIndex'],$steviloDodatnihSlik);
            //view za slike
        }
      }else{
          $slike = Image::getXByLikesUser($_SESSION['ImageIndex'],$steviloDodatnihSlik);
          //view za slike
      }
    }

  }


  public function like(){


  }

  public function dislike(){

  }



}

?>
