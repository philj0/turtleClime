<?php
  # config for connection with database
  $servername = 'localhost:8888';
  $username = 'root';
  $password = 'root';
  $database = 'turtleClime';

  #create connection to database
  $db = new mysqli($servername, $username, $password, $database);
?>
