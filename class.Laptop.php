<?php

class Laptop {

  public $model;
  public $speed;
  public $hd;
  public $ram;
  public $screen;
  public $price;

  public function update($model, $values) {
    $dbh = $this->connect();
    $updateString = "";
    foreach ($values as $key => $value) {
      $updateString .= "$key=\"$value\", ";
    }
    $updateString = rtrim($updateString, ", ");

    $query = "UPDATE laptop SET " . $updateString .
    " WHERE model = $model";

    $stmt = $dbh->prepare($query);
    if ($stmt->execute()) {
      return $this->getter($model);
    }
    else {
      return [$query, $stmt->errorInfo()];
    }
  }

  public function getter($model = 0) {

    // Skapa uppkoppling
    $dbh = $this->connect();

    // Om id == 0, ska alla rader visas.
    if ($model==0) {
      // Förbered en query.
      $stmt = $dbh->prepare("
        SELECT *
        FROM laptop
        WHERE 1
      ");
    }
    else {
      // Förbered en query.
      $stmt = $dbh->prepare("
        SELECT *
        FROM laptop
        WHERE model = :model
      ");
      // bindParam "binder" en variabel till ett namn,
      // vilket gör att vi ytterligare säkrar mot skadlig kod.
      $stmt->bindParam(":model", $model);
    }
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  /*
  * Behöver en associativ array med column => value.
  */
  public function setter(array $values) {
    $dbh = $this->connect();

    // Gör en sträng som innehåller klassens egenskaper
    $columns = "";
    // Gör en sträng som innehåller de värden som skickas till funktionen
    $vals = "";

    // Kolla om någon kolumn/värde saknas.
    foreach ($values as $key=>$value) {
      $columns .= $key . ", ";
      $vals .= "'" . $value . "', ";
    }
    // Ta bort det sista kommatecknet.
    $columns = rtrim($columns, ", ");
    $vals = rtrim($vals, ", ");

    $query = "
      INSERT INTO laptop
      (" . $columns . ")
      VALUES (" . $vals . ")";

    $stmt = $dbh->prepare($query);

    if ($stmt->execute()) {
      return $this->getter($values['model']);
    }
    else {
      echo $query;
      var_dump($stmt->errorInfo());
      exit;
    }
  }

  public function getForm($values) {
    $returstring = "<form action='index.php' method='POST'>";

    foreach ($this as $key=>$v) {
      $returstring .= "<br /><label for='$key'>$key</label>";
      $returstring .= "<input type='text' name='$key' value=' {$values[$key]} '/>";
    }
    $returstring .= "<p><input type='submit' value='Lägg in' name='submit' /></form>";
    return $returstring;
  }


  public function connect() {
    try {
      $dbh = new PDO("mysql: host=localhost; dbname=datorbutiken", "cpu", "brOmmablOcks");
    }
    catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
    return $dbh;
  }

}


 ?>
