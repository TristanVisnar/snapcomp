<?php
//pogled za vračanje oglasa v json obliki
//nastavimo ustrezen tip rezultata ter oglas ustrezno zakodiramo
header('Content-Type: application/json');
foreach ($slike as $slika) {
  echo json_encode($slika);
}

?>
