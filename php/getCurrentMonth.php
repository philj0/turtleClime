<?php
  require 'inc/db.php';

  if(isset($_POST['test'])){
    $select = $pdo->prepare("SELECT ID, Temp, Light_On, Light_Off, Timestamp from tc_data ORDER BY ID DESC LIMIT 30 ");
    $select->execute();

    if($select->rowCount() > 0) {
      $insert = $pdo->prepare("INSERT INTO tc_log (Action, Status, User) VALUES (?, ?, ?)");
      $insert->execute(array('Read complete Month', "successful", 'Admin'));

      foreach ($select as $row) {
        $tableRows .='<tr><td>'.$row['ID'].'</td><td>'.$row['Temp'].'°C</td><td>'.$row['Light_On'].'</td><td>'.$row['Light_Off'].'</td><td>'.$row['Timestamp'].'</td></tr>';
      }
    } else {
      $insert = $pdo->prepare("INSERT INTO tc_log (Action, Status, User) VALUES (?, ?, ?)");
      $insert->execute(array('Read complete Month', "ERROR", 'Admin'));

      $tableRows ='<tr><td>0</td><td>0°C</td><td>0000-00-00 00:00:00</td><td>0000-00-00 00:00:00</td><td>0000-00-00 00:00:00</td></tr>';
    }

    #concat table
    $tableStart = '<thead><tr><th>ID</th><th>Temperature</th><th>Light on</th><th>Light off</th><th>Timestamp</th></tr></thead><tbody>';
    $tableEnd ='</tbody>';
    $tableData = $tableStart.$tableRows.$tableEnd;

    $table = array(
      'tableData' => $tableData,
    );

    echo json_encode($table);

    # close connection
    $pdo = null;
  }
?>
