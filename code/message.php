<?php
  declare(strict_types = 1);

  //require_once('../database/connection.db.php');

  require_once('../templates/common.tpl.php');
  require_once('../templates/message.tpl.php');

  //$db = getDatabaseConnection();
  $name = 'Message';

  drawHead($category);
  drawHeader();
  drawMessage();
  drawFooter();
?>