<?php
  declare(strict_types = 1);

  session_start();

  if((!isset($_SESSION['user_id'])) || (!$_SESSION['admin'])) {
    header('Location: ../code/home.php');
    exit;
  }

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