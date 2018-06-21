<?php
  class CommandsAdapter extends Adapter {
    const TABLE = 'commands';


  public function __construct($link) {
    $this->_link = $link;
  }

  public function newCommand($command, $answer) {
    $sql = $this->_link->prepare('INSERT INTO `' . self::TABLE . '` (`id`, `command`, `answer`) VALUES (NULL,?,?)');
    $sql->bind_param('ss', $command, $answer);
    $result = $sql->execute();

    return $result;
  }

  public function getCommands() {
    $sql = $this->_link->prepare('SELECT * FROM `' . self::TABLE . '`');
    $sql->execute();

    return $sql;
  }

  public function getCommandById($id) {
    $sql = $this->_link->prepare('SELECT * FROM `' . self::TABLE . '` WHERE id=?');
    $sql->bind_param('i', $id);
    $result = $sql->execute();
    if ($result) {
      $res = $sql->get_result();
      if (!$res) {
        return false;
      }
      return $res->fetch_assoc();
    }
  }

  public function updateCommand($id, $command, $answer) {
    $sql = $this->_link->prepare('UPDATE `' . self::TABLE . '` SET command=?, answer=? WHERE id=?');
    $sql->bind_param('ssi', $command, $answer, $id);
    $sql->execute();

    return $sql;
  }

  public function getAnswer($command) {
    $sql = $this->_link->prepare('SELECT `answer` FROM `' . self::TABLE . '` WHERE command=?');
    $sql->bind_param('s', $command);
    $sql->execute();

    return $sql;
  }
}
?>
