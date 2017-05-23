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
    public $ACCNAME;
    public $USERNAME;
    public $PASS;
    public $DATEOFBIRTH;
    public $FIRSTNAME;
    public $SURNAME;
    public $COUNTRY;
    public $LANG;
    public $GENDER;
    public $ROLE;
    public $NUMOFPOSTS;
    public $NUMOFWINS;


    //konstrutkor, ki nam ustvari novi primerek razreda
    public function __construct($ID,$ACCNAME,$USERNAME,$PASS,$FIRSTNAME,$SURNAME,$COUNTRY,$LANG,$DATEOFBIRTH,$NUMOFPOSTS,$NUMOFWINS,$ROLE,$EMAIL,$GENDER) {
		$this->ID       = $ID;
		$this->EMAIL    = $EMAIL;
		$this->ACCNAME = $ACCNAME;
		$this->USERNAME = $USERNAME;
		$this->PASS     = $PASS;
		$this->DATEOFBIRTH = $DATEOFBIRTH;
		$this->FIRSTNAME = $FIRSTNAME;
		$this->SURNAME  = $SURNAME;
		$this->COUNTRY = $COUNTRY;
		$this->LANG = $LANG;
		$this->GENDER = $GENDER;
		$this->NUMOFPOSTS = $NUMOFPOSTS;
		$this->NUMOFWINS = $NUMOFWINS;
		$this->ROLE = $ROLE;
    }




    // funkcija za preverjanje prijave
    // vrne id uporabnika ali false, ob napaki pa "error"
    public function login($ACC_NAME,$PASS){
        $db = Db::getInstance();
		if($stmt = mysqli_prepare($db,"Select * from UPORABNIK where ACCNAME=? and PASS=?;")){
			mysqli_stmt_bind_param($stmt,"ss",$ACC_NAME,$PASS);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			mysqli_stmt_close($stmt);
			$row = mysqli_fetch_assoc($result);
			if($row){
				return $row;
			}
			else
				return "false";
		}
		return "error";

	}
	/*
	if($stmt = mysqli_prepare($db,"Select * from UPORABNIK where ACCNAME=? and PASS=?;")){
		mysqli_stmt_bind_param($stmt,"ss",$ac,$pass);
		mysqli_stmt_execute($stmt);
		$res = mysqli_stmt_get_result($stmt);
		$r = mysqli_fetch_assoc($res);
	var_dump($r);
	mysqli_stmt_close($stmt);
}else{
echo "Error!  ";
	*/



    // preveri email, ki ga dobi na vhodu, če obstaja v bazi
    // vrne index uporabnika s tem emailom drugače "false", ob napaki pa "error"
    public function check_EMAIL($EMAIL){

		$db = Db::getInstance();

		if ($stmt = mysqli_prepare($db, "SELECT * FROM UPORABNIK where EMAIL=?;")) {
			mysqli_stmt_bind_param($stmt, "s",$EMAIL);
			//izvedemo poizvedbo
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
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

		if ($stmt = mysqli_prepare($db, "SELECT * FROM UPORABNIK where ACCNAME=?;")) {

			mysqli_stmt_bind_param($stmt, "s",$ACC_NAME);

		//izvedemo poizvedbo
		$result = mysqli_stmt_execute($stmt);

		if($result){
			$list = ["ID"=>$result["ID"],"USERNAME"=>$result["USERNAME"],"ACCNAME"=>$result["ACCNAME"]];
			return $list;
		}
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


//      if ($stmt = mysqli_prepare($db, "SELECT * FROM UPORABNIK where ID=?;")) {

//       mysqli_stmt_bind_param($stmt, "i",$id);

       //izvedemo poizvedbo
//       $result = mysqli_stmt_execute($stmt);
//       if($result){
//    	  $row = mysqli_fetch_assoc($result);


	$res = mysqli_query($db,"select * from UPORABNIK;");
	$row = mysqli_fetch_assoc($res);
    	  //ker pričakujemo samo en rezultat, vrnemo en objekt razreda Oglas
        return new User($row['ID'], $row['ACCNAME'], $row['USERNAME'],$row['PASS'],$row['FIRSTNAME'], $row['SURNAME'],$row['COUNTRY'],$row['LANG'], $row['DATEOFBIRTH'],$row['NUMOFPOSTS'],$row['NUMOFWINS'],$row['ROLE'],$row['EMAIL'],$row['GENDER']);
      //}
    //}
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
