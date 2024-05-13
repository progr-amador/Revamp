<?php
  declare(strict_types = 1);

  session_start();

  if(!$_SESSION['admin']) header('Location: ' . $_SERVER['HTTP_REFERER']);

  require_once('../database/connection.db.php');
  require_once('../database/product.class.php');
  require_once('../database/baskets.class.php');
  require_once('../database/users.class.php');

  require_once('../templates/common.tpl.php');
  require_once('../templates/control_panel.tpl.php');

  $name = "Painel de Controlo";
  $db = getDatabaseConnection();

  drawHead($name);
  drawHeader();
  drawControlPanel($featured);
  drawFooter();
?>