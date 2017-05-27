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
      require("views/images/index.php");
    }
    require_once("views/images/browse_end.php");
  }

  // prikaze slike iz domace strani
  // vhod $_
  public function browse(){

      $steviloDodatnihSlik = 15;

      echo "1";

      //če je kategorija označena
      //if(isset($_GET['category'])){}
      if(!isset($_SESSION['ImageIndex'])){
        echo "2.1";
        if(isset($_GET['sort'])){
          echo "3.1";
          if($_GET['sort']=="new"){
              $slike = Image::getXByDate(1,$steviloDodatnihSlik);
              //dodaj en view za prikaz slike
              show($slike);
          }else{
            echo "4.1";
              $slike = Image::getXByLikes(1,$steviloDodatnihSlik);
              //dodaj en view za prikaz slike
              var_dump($slike);
              echo "5.1";
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
        echo "2.2";
        if(isset($_GET['sort'])){
          echo "3.2";
          if($_GET['sort']=="new"){

              $slike = Image::getXByDate($_SESSION['ImageIndex'],$steviloDodatnihSlik);

              //view za slike
              show($slike);
          }else{
              echo "4.2";
              $slike = Image::getXByLikes($_SESSION['ImageIndex'],$steviloDodatnihSlik);
              var_dump($slike);
              //view za slike
              echo "5.2";
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



}

?>
