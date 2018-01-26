<?php
  $host = 'localhost';
  $user = 'root';
  $passwd = 'root';
  $dbname = 'turtleClime';

  #$pdo = new PDO(sprintf('mysql:host=%s;dbname=%s', $host, $dbname), $user, $passwd);

  try {
    $pdo = new PDO(sprintf('mysql:host=%s;dbname=%s', $host, $dbname), $user, $passwd);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
      echo 'Verbindung fehlgeschlagen: ' . $e->getMessage();
  }

?>
