<?php
//dodamo razred za povezavo z bazo
require_once('connection.php');

//podobna funkcija kot v routes, s tem da dodatno pošiljamo v funkcije kontrolerja dva argumenta
//prvi je reuqest, ki predstavlja polje ukazov v zahtevi
//drugi je input ki predstavlja objekt, ki je bil apiju posredovan v json obliki
//noben parameter ni obvezen
function call($controller, $action,$request="",$input="") {
  echo "t4";
    require_once('controllers/' . $controller . '_controller.php');
    echo "t5";
  require_once('models/' . $controller . '.php');
  echo "t6";
    $o=$controller."_controller";
	$controller=new $o;
  echo "t7";
	$controller->{ $action }($request,$input);
  echo "t8";
  }

echo "t1";
 //prebermo metodo zahteve
$method = $_SERVER['REQUEST_METHOD'];
//iz zahteve v obliki api.php/a/b/c/d/.. naredimo polje
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));

//na api se lahko pri zahtevi pošljejo tudi surovi podatki, te se prebere iz toka podatkov php://input
//api pričakuje podatke v json obliki
//rezultat json_decode je objekt, če damo na konec argument true, dobimo asociativno polje
$input = json_decode(file_get_contents('php://input'));

///controler je prvi argument v ukazu -> api.php/controller/x/y/z

$controller=$request[0];

echo "t2";
//metoda zahteve nam določa katero akcijo bomo izvedli
//tukaj imamo ekvivalent strani routes.php, ki je precej poenostavljen
//v bolj zapletenih apijih je potrebno dodati malo več logike, ki kombinira vrsto metode ter podakte poslane v ukazu (pri nas $request), ter ustrezno kliče kontrolerje
switch ($method) {
		case 'GET':
    echo "t3";
		call($controller,"browseAPI",$request,$input);
		break;
		case 'PUT':
		//call($controller,"posodobiAPI",$request,$input);
		break;
		case 'POST':
		call($controller,"dodajAPI",$request,$input);
		break;
		case 'DELETE':
		//call($controller,"odstraniAPI",$request,$input);
		break;
	}
//primer ne vsebuje implementiranih vseh akcij, temveč samo prikaziAPI in dodajAPI




?>
