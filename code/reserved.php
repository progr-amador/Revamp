<?php
  declare(strict_types = 1);

  session_start();

  require_once('../database/connection.db.php');
  require_once('../database/product.class.php');
  require_once('../csrf_token.php');
  require_once('../templates/common.tpl.php');
  require_once('../templates/reserved.tpl.php');

  $name = "Reservados";
  $db = getDatabaseConnection();
  $reserved = Product::getReserved($db, $_SESSION['user_id']);

  drawHead($name);
  drawHeader();
  drawReserved($reserved);
  drawFooter();
?>