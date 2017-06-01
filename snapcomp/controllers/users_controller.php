<?php

  /*
    Funkcije:
      - getUser - dobi in predstavi podatke uporabnika
      - add - preusmeri uporabnika na stran za REGISTRACIJO
      - register - se klice po izpolnitvi forme
      - login - klice se ob prijavi uporabnika

  */


	class users_controller {

		// ob klicu find nam vrne podatke od uporabnika z id-jem
    	public function profileUser() {
			//če uporabnik ne posreduje ID uporabnika, pokličemo akcijo napaka
			if(!isset($_SESSION["ID"])){
        header("?controller=pages&action=login");
				//require_once("views/users/login.php");
			}
			else{
				$user = User::find($_SESSION["ID"]);
				if($user == "false"){
			//ta uporabnik ne obstaja -
					header("Location: ?controller=pages&action=error"); /// možen klic tudi bolj prilagojene funkcije - uporabnik ne obstaja
				}
				else
				{
				//vključimo view, da prikažemo uporabnika
					require_once('views/pages/profilePage.php'); /////NASTAVI KATERI FILE BO POKAZAL UPORABNIKA
				}
			}
    	}
		public function logout(){
			if($logoutReturn = User::logout()){
				header("Location: ?controller=pages&action=home");
			}
			else{
				header("Location: ?controller=pages&action=error");
			}
		}
	// register se kliče, ko izpolnimo formo
	public function register() {

    //NASTAVI NASLOVE ZA POST in PREVERJAJ PRAVILNOST PODATKOV -- PREVERI EMAIL in če ACC_NAME obstaja
	    	$email = $_POST["regEmail"];

    //preveri email z RESTfull api-jem

    //za preverjanje email naslovov iz vaje 3, uporabite sledeči naslov
    //ker gre za navadno get zahtevo, ni potrebno nastavljati options objekta
    //$o=file_get_contents(http://apilayer.net/api/check?access_key=1ec7aee28117f0042e3f5773be3b71ac&email=marko.ferme@um.si&smtp=1&format=1)
    //če bo ključ prekoračil 1000 zahtev na mesec, si na strani ustvarite svoj ključ
    //na strani je tudi opisan format odgovora, nas bo zanimala predvsem mx_found lastnost

			if($_POST["regPassword"] != $_POST["regConfirmPassword"]){
				header("Location: ?controller=pages&action=register&passcheckerror=true");
				exit();
			}
    		$ret_email = User::check_EMAIL($email);      /// preveri EMAIL
    		$user = $_POST["regAccountName"];
    		$ret_user = User::check_ACC_NAME($user);     /// preveri ACC_NAME
    		if($ret_email == "error" || $ret_user == "error")
      			header("Location: ?controller=pages&action=error");
			if($ret_email != "false" && $ret_user!="false"){
				header("Location: ?controller=pages&action=register&email=$email&acc=$user");
			}
    		if($ret_email != "false"){
				header("Location: ?controller=pages&action=register&email=$email");
        //KAJ NAREDI V PRIMERU KO MAIL ŽE OBSTAJA
    		}
    		if($ret_user != "false"){
				header("Location: ?controller=pages&action=register&acc=$user");
        //KAJ NAREDI V PRIMERU KO ACC_NAME ŽE OBSTAJA
    		}
    		if($ret_email == "false" && $ret_user == "false"){
        //SE ZGODI OB USPEŠNI PREVERITVI PODATKOV
  			    $user=User::save($_POST["regEmail"],$_POST["regAccountName"],$_POST["regUsername"],$_POST["regPassword"],$_POST["regBirthDate"],$_POST["regFirstName"],$_POST["regLastName"],$_POST["regCountry"],$_POST["optradio1"],$_POST["optradio2"]);
            if($user=="error"){
                header("Location: ?controller=pages&action=error");
            }else{
                $_SESSION["ID"] = $user["ID"];
        		$_SESSION["USERNAME"] = $user["USERNAME"];
        		$_SESSION["ACCNAME"] = $user["ACCNAME"];
        		$_SESSION["USERNAME"] = $user["USERNAME"];
        		$_SESSION["TEST"] = $user["LANG"];
  			//naložimo pogled, ki potrjuje uspešnost dodajanja
  		        header("Location: ?controller=pages&action=home");
            }
   	    }
        header("Location: ?controller=pages&action=error");
    }


		public function login(){
			$id = User::login($_POST["ACCNAME"],$_POST["PASS"]);
			//var_dump($_POST);
			if($id == "error"){
				header("Location: ?controller=pages&action=error");
			}
			if($id == "false"){
				//error napačna prijava -- preusmeri nazaj na
				$_GET["error"] = "true";
				require_once("views/users/login.php");
				return;
			}else{
				//nastavimo sessionu id
				$_SESSION["ID"] = $id->ID;
				$_SESSION["USERNAME"] = $id->USERNAME;
				$_SESSION["ACCNAME"] = $id->ACCNAME;
				header("Location: ?controller=pages&action=home"); // vrne nas na home page;
			}
		}


    public function loginAPI($request,$input){
      echo "$input[0]->ACCNAME,$input[0]->PASS \n";
      $id = User::login($input->ACCNAME,$input->PASS);
      header('Content-Type: application/json');
      //echo json_encode($id);

    }

    public function postAPI($request,$input){
        users_controller::loginAPI($request,$input);

    }

	}
?>
