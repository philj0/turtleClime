<?php
  if(isset($_POST['test'])){
    require 'inc/db.php';

    $select = $pdo->prepare("SELECT ID, Timestamp, Action, Status, User from tc_log ORDER BY ID DESC LIMIT 10 ");

    $select->execute();

    if($select->rowCount() > 0) {
      $insert = $pdo->prepare("INSERT INTO tc_log (Action, Status, User) VALUES (?, ?, ?)");
      $insert->execute(array('Read Log', "successful", 'Admin'));

      $tableStart = '<table class="table table-dark table-hover"><thead><tr><th>ID</th><th>Timestamp</th><th>Action</th><th>Status</th><th>User</th></tr></thead><tbody>';
      $tableEnd ='</tbody></table>';

      foreach ($select as $row) {
        $tableRows .='<tr><td>'.$row['ID'].'</td><td>'.$row['Timestamp'].'</td><td>'.$row['Action'].'</td><td>'.$row['Status'].'</td><td>'.$row['User'].'</td></tr>';
      }
    } else {
      $insert = $pdo->prepare("INSERT INTO tc_log (Action, Status, User) VALUES (?, ?, ?)");
      $insert->execute(array('Read Log', "ERROR", 'Admin'));

      $tableRows ='<tr><td>0</td><td>0°C</td><td>0%</td><td>0000-00-00 00:00:00</td><td>0000-00-00 00:00:00</td></tr>';
    }

    $tableData = $tableStart.$tableRows.$tableEnd;

    $table = array(
      'tableData' => $tableData,
    );

    echo json_encode($table);

    # close connection
    $pdo = null;
  }
?>
