<?php
// Se alla fel under development.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("class.Laptop.php");


// Updater
$laptop = new Laptop();

// Hämta all info om objektet.
$model2001 = $laptop->getter(2001);

// Skriv ut formulär med värden.
echo $laptop->getForm($model2001[0]);

// Ta emot värden från formuläret.
if (isset($_POST['submit'])) {
  $insertValues = $_POST;
  // Ta bort submiten
  array_pop($insertValues);
  // Anropa settern och skriv ut resultatet.
  print_r ($laptop->update(2001, $insertValues));

}
?>
