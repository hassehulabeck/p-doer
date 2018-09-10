<?php
try {
  $dbh = new PDO("mysql: host=localhost; dbname=datorbutiken", "cpu", "brOmmablOcks");
}
catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

// Förbered en query.
$stmt = $dbh->prepare("
  SELECT *
  FROM laptop
  WHERE 1
");

// Kör queryn
$stmt->execute();

// Plocka fram datan.
print_r($stmt->fetchAll(PDO::FETCH_ASSOC));
?>
