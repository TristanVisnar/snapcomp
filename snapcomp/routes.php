<?php

//usmerjevalnik


//funkcija, ki kliče kontrolerje in hkrati vključuje njihovo kodo
  function call($controller, $action) {
	//naložimo datoteko z razredom kontrolerja
    require_once('controllers/' . $controller . '_controller.php');
	//naložimo model, ki ga kontroler potrebuje
	//modele bi lahko nalagali tudi v konstruktorju kontrolerja, namesto tukaj
	require_once('models/' . $controller . '.php');
	//pripravimo ime razreda kontrolerja
    $o=$controller."_controller";
	//ustvarimo objekt razreda kontrolerja
	$controller=new $o;
//pokličemo akcijo
	$controller->{ $action }();

  }

  //vsi dovoljeni kontrolerji, v našem primeru 2
  //tukaj lahko dodamo tudi avtentikacijo (preverjamo, če je uporabnik v seji in ali ima pravice izvesti določeno akcijo)
   $controllers = array('pages' => ['home', 'error', 'browse', 'login', 'register', 'NSFW', 'profile'],
                        'users' => ['profileUser', 'add','register','login', 'redirect', 'logout'],
			'images' => ['browse', 'user','like','dislike']
	       	       );
  if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
      call($controller, $action);
    } else {
      call('home', 'error');
    }
  } else {
    call('home', 'error');
  }
?>
