<?php

include_once("class.Laptop.php");

$query = new Laptop();

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
?>
