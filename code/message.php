<?php
  declare(strict_types = 1);

  session_start();

  //require_once('../database/connection.db.php');

  require_once('../templates/common.tpl.php');
  require_once('../templates/message.tpl.php');

  //$db = getDatabaseConnection();
  $name = 'Mensagens';

  drawHead($name);
  drawHeader();
  drawMessage();
  drawFooter();
?>