<?php
$months = array(
  '01' => 'ene', '02' => 'feb', '03' => 'mar', '04' => 'abr',
  '05' => 'may', '06' => 'jun', '07' => 'jul', '08' => 'ago',
  '09' => 'sep', '10' => 'oct', '11' => 'nov', '12' => 'dic'
);

function displayMonths(){
  date_default_timezone_set('America/Mazatlan');
  $meses = array(
    1 => "Enero",
    2 => "Febrero",
    3 => "Marzo",
    4 => "Abril",
    5 => "Mayo",
    6 => "Junio",
    7 => "Julio",
    8 => "Agosto",
    9 => "Septiembre",
    10 => "Octubre",
    11 => "Noviembre",
    12 => "Diciembre"
  );

  $mesActual = date("n"); // Obtiene el número del mes actual (sin ceros iniciales)

  foreach ($meses as $numeroMes => $nombreMes) {
      $selected = ($numeroMes == $mesActual) ? "selected" : "";
      echo "<option value='$numeroMes' $selected>$nombreMes</option>";
  }
}
?>