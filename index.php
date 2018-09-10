<?php
// Se alla fel under development.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("class.Laptop.php");


// Updater
$laptop = new Laptop();

// Lista alla laptops.
$result = $laptop->getter();
echo "<h1>Lista över laptops</h1><ul>";
foreach ($result as $row) {
  echo "<li><a href='index.php?model=" . $row['model'] . "'>" . $row['model'] . "</a>";
  echo $row['price'] . " kr";
}
echo "</ul>";

if (isset($_GET['model'])) {
  $model = $_GET['model'];
  $result = $laptop->getter($model);
  $modelObjekt = $laptop->getter($model);

  // Skriv ut formulär med värden.
  echo $laptop->getForm($modelObjekt[0]);

}


// Ta emot värden från formuläret.
if (isset($_POST['submit'])) {
  $insertValues = $_POST;
  // Ta bort submiten
  array_pop($insertValues);
  // Anropa settern och skriv ut resultatet.
  print_r ($laptop->update(2001, $insertValues));

}

?>
