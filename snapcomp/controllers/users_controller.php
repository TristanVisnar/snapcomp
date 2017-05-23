<?php

  /*
    Funkcije:
      - getUser - dobi in predstavi podatke uporabnika
      - add - preusmeri uporabnika na stran za REGISTRACIJO
      - register - se klice po izpolnitvi forme
      - login - klice se ob prijavi uporabnika

  */


  class users_controller {

 /*   // ob klicu find nam vrne podatke od uporabnika z id-jem
    	public function getUser() {
//		echo "   wurk";
//		$_SESSION['FAIL'] = "1";
//		echo "OKE RATALO JE NE";
	    //če uporabnik ne posreduje ID uporabnika, pokličemo akcijo napaka
	        if (!isset($_GET['id']))
		      return call('pages', 'error');

     		 $user = User::find($_GET['id']);
      		if($user == "false"){
        //ta uporabnik ne obstaja -
        		return call('pages', 'error'); /// možen klic tudi bolj prilagojene funkcije - uporabnik ne obstaja
	        }
		else
		{
	    //vključimo view, da prikažemo uporabnika
      			require_once('views/v1.php'); /////NASTAVI KATERI FILE BO POKAZAL UPORABNIKA
    		}
    	}
*/
/*	//uporabnik želi dodati oglas, vrnemu mu pogled z uporabniškim vmesnikom (formo) za dodajanje oglasa
	public function add() {
		require_once('views/users/'); /////PREUSMERI TE NA STRAN ZA REGISTRACIJO
	}
*/

	// register se kliče, ko izpolnimo formo
	public function register() {

    //NASTAVI NASLOVE ZA POST in PREVERJAJ PRAVILNOST PODATKOV -- PREVERI EMAIL in če ACC_NAME obstaja

    $_SESSION["reg"] = var_dump($_POST);
    /*
	    	$email = $_POST["regEmail"];

    //preveri email z RESTfull api-jem

    //za preverjanje email naslovov iz vaje 3, uporabite sledeči naslov
    //ker gre za navadno get zahtevo, ni potrebno nastavljati options objekta
    //$o=file_get_contents(http://apilayer.net/api/check?access_key=1ec7aee28117f0042e3f5773be3b71ac&email=marko.ferme@um.si&smtp=1&format=1)
    //če bo ključ prekoračil 1000 zahtev na mesec, si na strani ustvarite svoj ključ
    //na strani je tudi opisan format odgovora, nas bo zanimala predvsem mx_found lastnost


    		$ret_email = Users::check_EMAIL($email);      /// preveri EMAIL
    		$user = $_POST[];
    		$ret_user = Users::check_ACC_NAME($user);     /// preveri ACC_NAME
    		if($ret_email == "error" || $ret_user == "error")
      			return call('pages', 'error');
    		if($ret_email != "false"){
      //KAJ NAREDI V PRIMERU KO MAIL ŽE OBSTAJA
    		}
    		if($ret_email != "false"){
      //KAJ NAREDI V PRIMERU KO ACC_NAME ŽE OBSTAJA
    		}
    		if($ret_email == "false" && $ret_user == "false"){
      //SE ZGODI OB USPEŠNI PREVERITVI PODATKOV
  			$user=Users::save($_POST["regEmail"],$_POST["regAccountName"],$_POST["regUsername"],$_POST["regPassword"],$_POST["regBirthDate"],$_POST["regFirstName"],$_POST["regLastName"],$_POST["regCountry"],$_POST[""],$_POST[""]);
  			//naložimo pogled, ki potrjuje uspešnost dodajanja
  		require_once('views/users/');
*/    	//}
}


	public function login(){
		$id = User::login($_POST["ACCNAME"],$_POST["PASS"]);
		var_dump($_POST);
		if($id == "error"){
			return call('pages','error');
		}
		if($id == "false"){
			//error napačna prijava -- preusmeri nazaj na
			$_GET["error"] = "true";
			require_once("views/users/login.php");
			return;
		}else{
			//nastavimo sessionu id
			$_SESSION["ID"] = $id["ID"];
			$_SESSION["USERNAME"] = $id["USERNAME"];
			$_SESSION["ACCNAME"] = $id["ACCNAME"];
			$_SESSION["USERNAME"] = $id["USERNAME"];
      $_SESSION["TEST"] = $id["LANG"];
			return call('pages','home'); // vrne nas na home page;
		}
	}

}
?>
