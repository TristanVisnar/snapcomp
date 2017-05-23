<?php

  /*osnoven model za uporabnika:
    - _construct - konstruktor za objekt User,
    - login - funkcija, ki preverja vpis,
    - check_EMAIL - preverja obstajanje emaila v bazi
    - check_ACC_NAME - preverja obstajanje ACC_NAME v bazi
    - find - funkcija, za pridobitev podatkov enega uporabnika,
    - save - funkcija za dodajanje uporabnika, izvede se ob registraciji
    */


  class User{

    public $ID;
    public $EMAIL;
    public $ACC_NAME;
    public $USERNAME;
    public $PASS;
    public $DATEOFBIRTH;
    public $FIRSTNAME;
    public $SURNAME;
    public $COUNTRY;
    public $LANG;
    public $GENDER;

    public $NUMBEROFPOSTS;
    public $NUMOFWINS;


    //konstrutkor, ki nam ustvari novi primerek razreda
      public function __construct($ID,$EMAIL,$ACC_NAME,$USERNAME,$PASS,$DATEOFBIRTH,$FIRSTNAME,$SURNAME,$COUNTRY,$LANG,$GENDER,$NUMBEROFPOSTS,$NUMOFWINS) {
        $this->ID       = $ID;
        $this->EMAIL    = $EMAIL;
        $this->ACC_NAME = $ACC_NAME;
  	    $this->USERNAME = $USERNAME;
        $this->PASS     = $PASS;
        $this->DATEOFBIRTH = $DATEOFBIRTH;
        $this->FIRSTNAME = $FIRSTNAME;
        $this->SURNAME  = $SURNAME;
        $this->COUNTRY = $COUNTRY;
        $this->LANG = $LANG;
        $this->GENDER = $GENDER;
        $this->NUMBEROFPOSTS = $NUMBEROFPOSTS;
        $this->NUMOFWINS = $NUMOFWINS;
      }




    // funkcija za preverjanje prijave
    // vrne id uporabnika ali false, ob napaki pa "error"
    public function login($ACC_NAME,$PASS){

      $db = Db::getInstance();

      if ($stmt = mysqli_prepare($db, "SELECT * FROM UPORABNIK where ACC_NAME=? and PASS=?")) {

       mysqli_stmt_bind_param($stmt, "ss",$ACC_NAME,$PASS);

       //izvedemo poizvedbo
       $result = mysqli_stmt_execute($stmt);

       if($result)
        return $result['ID'];
       else
        return "false";
     }

     return "error";
    }




    // preveri email, ki ga dobi na vhodu, če obstaja v bazi
    // vrne index uporabnika s tem emailom drugače "false", ob napaki pa "error"
    public function check_EMAIL($EMAIL){

      $db = Db::getInstance();

      if ($stmt = mysqli_prepare($db, "SELECT * FROM UPORABNIK where EMAIL=?")) {

       mysqli_stmt_bind_param($stmt, "s",$EMAIL);

       //izvedemo poizvedbo
       $result = mysqli_stmt_execute($stmt);

       if($result)
        return $result['ID'];
       else
        return "false";
     }

     return "error";
    }



    // preveri account name, ki ga dobi na vhodu, če obstaja v bazi
    // vrne index uporabnika s tem ACC_NAME drugače "false", ob napaki pa "error"
    public function check_ACC_NAME($ACC_NAME){

      $db = Db::getInstance();

      if ($stmt = mysqli_prepare($db, "SELECT * FROM UPORABNIK where ACC_NAME=?")) {

       mysqli_stmt_bind_param($stmt, "s",$ACC_NAME);

       //izvedemo poizvedbo
       $result = mysqli_stmt_execute($stmt);

       if($result)
        return $result['ID'];
       else
        return "false";

     }

     return "error";

  }





    // funkcija najdi zahteva id uporabnika
    // in vrne objekt User
    public function find($id){
      //preverimo, da je id v številski obliki
      $id = intval($id);

  	  //izvedemo poizvedbo
      $db = Db::getInstance();

      if ($stmt = mysqli_prepare($db, "SELECT * FROM UPORABNIK where id=?")) {

       mysqli_stmt_bind_param($stmt, "i",$id);

       //izvedemo poizvedbo
       $result = mysqli_stmt_execute($stmt);

       if($result){
    	  $row = mysqli_fetch_assoc($result);

    	  //ker pričakujemo samo en rezultat, vrnemo en objekt razreda Oglas
        return new User($row['ID'], $row['ACC_NAME'], $row['USERNAME'],$row['PASSWORD'],$row['FIRSTNAME'], $row['SURNAME'],$row['COUNTRY'],$row['LANG'], $row['DATEOFBIRTH'],$row['GENDER'],$row['NUMBEROFPOSTS'],$row['NUMOFWINS']);
      }
    }
    return "error";
  }






    //funkcija za dodajanje uporabnika
    //ne vrne uporabnika ali pa false
    public function save($EMAIL,$ACC_NAME,$USERNAME,$PASS,$DATEOFBIRTH,$FIRSTNAME,$SURNAME,$COUNTRY,$LANG,$GENDER){


      if($FIRSTNAME == "NULL" || $FIRSTNAME == "" || $FIRSTNAME == null)
        $FIRSTNAME == "";
      if($SURNAME == "NULL" || $SURNAMEL == "" || $SURNAME == null)
        $SURNAME == "";
      if($COUNTRY == "NULL" || $COUNTRY == "" || $COUNTRY == null)
        $COUNTRY == "";
      if($LANG == "NULL" || $LANG == "" || $LANG == null)
        $LANG == "";
      if($GENDER == "NULL" || $GENDER == "" || $GENDER == null)
        $GENDER == 'NULL';
      $db = Db::getInstance();

      if ($stmt = mysqli_prepare($db, "Insert into UPORABNIK (EMAIL,ACC_NAME,USERNAME,PASS,DATEOFBIRTH,FIRSTNAME,SURNAME,COUNTRY,LANG,GENDER,NUMBEROFPOSTS,NUMOFWINS) Values (?,?,?,?,?,?,?,?,?,?,0,0)")) {

			   mysqli_stmt_bind_param($stmt, "sssssssss",$EMAIL,$ACC_NAME,$USERNAME,$PASS,$DATEOFBIRTH,$FIRSTNAME,$SURNAME,$COUNTRY,$LANG,$GENDER);

			   //izvedemo poizvedbo
			   mysqli_stmt_execute($stmt);



	     mysqli_stmt_close($stmt);
 	    }

      return User::login($ACC_NAME,$PASS);

    }
  }

 ?>
