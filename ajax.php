<?php
  if (isset($_GET['command'])) {
    include_once 'connect.php';
    include_once 'Adapter/Adapter.php';
    include_once 'Adapter/CommandsAdapter.php';
    $commAdapter = new CommandsAdapter($link);
    $command = $_GET['command'];
    $result = $commAdapter->getAnswer($command);
    if ($result) {
      $res = $result->get_result();
      $row = $res->fetch_assoc();
      date_default_timezone_set('Europe/Samara');
      echo date('H:i:s T') . ' (YOU): ' . $command . '<br>';
      if (!$row){
        echo date('H:i:s T') . ' (BOT): I do not understand <br>';
      }
      else {
        echo date('H:i:s T') . ' (BOT): ' . $row['answer'] . '<br>';
      }
    }
  }
 ?>
