<?php
//prikaz vsebine za index stran

  class pages_controller {

	 //akcija domov, ki ne potrebuje pravega modela, ampak samo nastavi fiksne vrednosti spremenljivk, ki jih view prikaže
    public function home() {
		require_once('views/pages/home.php');
    }

	//akcija napaka, ki naloži view z obvestilom o napaki
    public function error() {
		require_once('views/pages/error.php');
    }
	public function browse(){
		require_once('views/pages/browse.php');
	}
	public function login(){
		require_once('views/users/login.php');
	}
	public function register(){
		require_once('views/users/register.php');
	}
	public function NSFW(){
		if(isset($_SESSION['NSFW'])){
			if($_SESSION['NSFW'] == "1")//ce je NSFW Vklopljen
			{
				$_SESSION['NSFW'] = "0";
			}
			else //Drugace ga vklopimo
			{
				$_SESSION['NSFW'] = "1";
			}
		}
		else{
			require_once("views/pages/error");
		}
		require_once("views/pages/browse.php");
	}

  public function errorAPI() {
  require_once('views/pages/errorAPI.php');
  }

  }
?>
