<?php
// Se alla fel under development.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("class.Laptop.php");

$query = new Laptop();

echo $query->getForm();

// Ta emot värden från formuläret.
if (isset($_POST['submit'])) {
  $insertValues = $_POST;
  // Ta bort submiten
  array_pop($insertValues);
  // Anropa settern och skriv ut resultatet.
  print_r ($query->setter($insertValues));

}
?>
