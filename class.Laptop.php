<?php

class Laptop {

  public $model;
  public $speed;
  public $hd;
  public $ram;
  public $screen;
  public $price;

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
