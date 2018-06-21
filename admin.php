<html>
<?php
  include_once 'connect.php';
  include_once 'Adapter/Adapter.php';
  include_once 'Adapter/CommandsAdapter.php';
  $commAdapter = new CommandsAdapter($link);
  if (!isset($_GET['id'])) {
?>
  <body>
    <h2>New command form:</h2>
    <form method="post">
      <label>Trigger:</label>
      <input type="text" name="command">
      <label>Answer:</label>
      <input type="text" name="answer">
      <br>
      <button type="submit" name="trigger">Create</button>
    </form>
    <?php

      if (isset($_POST['trigger'])) {
        $command = $_POST['command'];
        $answer = $_POST['answer'];
        $res = $commAdapter->newCommand($command, $answer);

        if ($res) {
          echo 'Yay! You did it!';
        }
        else {
          echo 'Sucker.';
        }
      }
    }
    else {
      $id = intval($_GET['id']);
      $command = $commAdapter->getCommandById($id);
      ?>
      <body>
        <h2>Edit command:</h2>
        <form method="post">
          <label>Trigger:</label>
          <input value="<?php echo $command['command'] ?>" type="text" name="command">
          <label>Answer:</label>
          <input value="<?php echo $command['answer'] ?>" type="text" name="answer">
          <br>
          <button type="submit" name="edit">Edit</button>
        </form>
      <?php
      if (isset($_POST['edit'])) {
        $command = $_POST['command'];
        $answer = $_POST['answer'];
        $sql = $commAdapter->updateCommand($id, $command, $answer);
      }
    }
      $sql = $commAdapter->getCommands();
      $result = $sql->get_result();
      while ($row = $result->fetch_assoc()){
        $commId = $row['id'];
        $command = $row['command'];
        echo '<a href="?id=' . $commId . '">' . $command . '</a> <br>';
      }
    ?>
  </body>
</html>
