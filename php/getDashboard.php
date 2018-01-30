<?php
  require 'inc/db.php';

  if(isset($_POST['test'])){
    $select = $pdo->prepare("SELECT ID, Temp, Light_On, Light_Off, Timestamp from tc_data ORDER BY ID DESC LIMIT 1 ");

    $select->execute();

    if($select->rowCount() > 0) {
      $insert = $pdo->prepare("INSERT INTO tc_log (Action, Status, User) VALUES (?, ?, ?)");
      $insert->execute(array('Read simple Value', "successful", $user));

      foreach ($select as $row) {
        $temp = '<div class="clearfix"><div class="c100 p'.round($row['Temp']).' big red"><span>'.$row['Temp'].'°C</span><div class="slice"><div class="bar"></div><div class="fill"></div></div></div></div>';
        $lightOn = date( "H:i:s", strtotime($row['Light_On']));
        $lightOff = date( "H:i:s", strtotime($row['Light_Off']));
        $timeStamp = date( "d-m-Y H:i:s", strtotime($row['Timestamp']));
      }
    } else {
      $insert = $pdo->prepare("INSERT INTO tc_log (Action, Status, User) VALUES (?, ?, ?)");
      $insert->execute(array('Read', "ERROR", $user));

      $temp = '<div class="clearfix"><div class="c100 p0 big red"><span>0°C</span><div class="slice"><div class="bar"></div><div class="fill"></div></div></div></div>';
      $lightOn = '00:00:00';
      $lightOff = '0:00:00';
      $timeStamp = '00-00-0000 00:00:00';
    }

    $data = array(
     'temp' => $temp,
     'lightOn' => $lightOn,
     'lightOff' => $lightOff,
     'timeStamp' => $timeStamp,
    );

    echo json_encode($data);

    # close connection
    $pdo = null;
  }
?>
