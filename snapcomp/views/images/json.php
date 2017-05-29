<?php
//pogled za vračanje oglasa v json obliki
//nastavimo ustrezen tip rezultata ter oglas ustrezno zakodiramo
header('Content-Type: application/json');

echo json_encode($slike,JSON_FORCE_OBJECT);


?>
