<?php
  $host = 'localhost';
  $user = 'root';
  $passwd = 'root';
  $dbname = 'turtleClime';

  $pdo = new PDO(sprintf('mysql:host=%s;dbname=%s', $host, $dbname), $user, $passwd);

?>
