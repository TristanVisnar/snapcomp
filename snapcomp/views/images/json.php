<?php
//pogled za vračanje oglasa v json obliki
//nastavimo ustrezen tip rezultata ter oglas ustrezno zakodiramo
echo "SEM V DATOTEKI";
header('Content-Type: application/json');
foreach ($slike as $slika) {
  echo json_encode($slika);
}

?>
