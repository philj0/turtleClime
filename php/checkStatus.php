<?php
  require 'inc/db.php';

  if(isset($_POST['status'])){
    if($pdo != null) {
      $insert = $pdo->prepare("INSERT INTO tc_log (Action, Status, User) VALUES (?, ?, ?)");
      $insert->execute(array('Check Status', "successful", 'Admin'));

      # mySQL status
      $tableRows = '<tr><td>MySQL</td><td><span class="badge badge-success">Alive</span></td></tr>';

      # get last ID from tc_data
      $select = $pdo->prepare("SELECT ID from tc_data ORDER BY ID DESC LIMIT 1 ");
      $select->execute();

      if($select->rowCount() > 0) {
        $insert = $pdo->prepare("INSERT INTO tc_log (Action, Status, User) VALUES (?, ?, ?)");
        $insert->execute(array('Check Status', "successful", 'Admin'));

        # tc_data status
        $tableRows .= '<tr><td>TC_Data</td><td><span class="badge badge-success">Alive</span></td></tr>';
      } else {
        # tc_data status
        $tableRows .= '<tr><td>TC_Data</td><td><span class="badge badge-danger">Dead</span></td></tr>';
      }

      # get last ID from tc_log
      $select = $pdo->prepare("SELECT ID from tc_log ORDER BY ID DESC LIMIT 1 ");
      $select->execute();

      if($select->rowCount() > 0) {
        #tc_log status
        $tableRows .= '<tr><td>TC_Log</td><td><span class="badge badge-success">Alive</span></td></tr>';
      } else {
        #tc_log status
        $tableRows .= '<tr><td>TC_Log</td><td><span class="badge badge-danger">Dead</span></td></tr>';
      }

    } else {
      #mySQL status
      $tableRows = '<tr><td>MySQL</td><td><span class="badge badge-danger">Dead</span></td></tr>';
      $tableRows .= '<tr><td>TC_Data</td><td><span class="badge badge-danger">Dead</span></td></tr>';
      $tableRows .= '<tr><td>TC_Log</td><td><span class="badge badge-danger">Dead</span></td></tr>';
    }

    # concat table
    $tableStart = '<tbody>';
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
