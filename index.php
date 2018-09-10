<?php
// Se alla fel under development.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("class.Laptop.php");

$query = new Laptop();
/*
// Visa alla rader.
$result = $query->getter();

foreach ($result as $row) {
  foreach ($row as $key => $value) {
    echo "<p>" . $key . " " . $value;
  }
}


// Visa en modell.
echo "<p>";
var_dump($query->getter(2001));
*/

/*
// Assoc. array med ny rad.
$newLaptop = [
    'model' => 290,
    'speed' => 300,
    'ram' => 512,
    'hd' => 900,
    'screen' => "26.2\"",
    'price' => 16045
  ];

print_r ($query->setter($newLaptop));

*/

echo $query->getForm();
if (isset($_POST['submit'])) {
  $insertValues = $_POST;
  // Ta bort submiten
  array_pop($insertValues);
  print_r ($query->setter($insertValues));

}
?>
