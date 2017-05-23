<?php
  class Db {
	  //razredna spremenljivka, ki nam predstavlja objekt, potreben za povezavo na bazo
    private static $instance = NULL;


	//razredna funkcija, s katero bomo pridobili ta objekt
    public static function getInstance() {
    //če še objekt ni inicializiran, ga nastavimo
      if (!isset(self::$instance)) {

	   //glede na vašo podatkovno bazo, morate tukaj ustrezno spremeniti podatke za prijavo
        self::$instance = mysqli_connect("localhost", "root", "root", "vaja2");

        /* check connection */
        if (mysqli_connect_errno()) {
          printf("Connect failed: %s\n", mysqli_connect_error());
          exit();
        }


      }
	  //vrnemo objekt, da lahko nato izvajamo povpraševanja na bazo
      return self::$instance;
    }
  }
?>
