<?php

//funckija pokliče naš api iz php kode
function kliciApi(){
//nastavimo url
//url mora biti vedno absoluten, saj php ne ve, na kateri domeni, portu, itd.. teče api, tudi če uporabljate lasten api na istem strežniku
//tukaj ni omejitev klica znotraj iste domene
//za uporabo na strežniški strani JSONP ni primeren
$url="http://localhost/mvc//api.php/oglasi";

//nastavimo podatke
$postdata = array(
        'naslov' => 'iz PHP',
        'vsebina' => 'Iz PHP'
    );//oz. json
	
//nastavimo možnosti pošiljanja,torej metodo, vrsto podatkov in same podatke (content mora biti niz, zato json_enconde)
$opts = array('http' =>
    array(
        'method'  => 'POST',
        'header'  => "Content-type: application/json;",
        'content' => json_encode($postdata)
		
    )
);
//iz naših možnosti ustvarimo tok podatkov
$context = stream_context_create($opts);
//izvedemo zahtevo na $url
//2. argument je false, saj bomo delali zahteve na http naslove in ne lokalno
//3. argument so opcije naše zahteve in sami podatki
file_get_contents($url, false, $context);
//file_get_contents vrne vsebino zahteve, torej json niz, ki ga vračajo naši apiji
}

kliciApi();


//za preverjanje email naslovov iz vaje 3, uporabite sledeči naslov
//ker gre za navadno get zahtevo, ni potrebno nastavljati options objekta
//$o=file_get_contents(http://apilayer.net/api/check?access_key=1ec7aee28117f0042e3f5773be3b71ac&email=marko.ferme@um.si&smtp=1&format=1)
//če bo ključ prekoračil 1000 zahtev na mesec, si na strani ustvarite svoj ključ
//na strani je tudi opisan format odgovora, nas bo zanimala predvsem mx_found lastnost 
?>

