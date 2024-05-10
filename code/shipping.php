<?php
  declare(strict_types = 1);

  session_start();

  require_once('../database/connection.db.php');
  require_once('../database/category.class.php');

  require_once('../templates/common.tpl.php');
  require_once('../templates/shipping.tpl.php');

  $db = getDatabaseConnection();
  $name = 'Envio';

  $districts = Category::getDistricts($db);

  drawHead($name);
  drawHeader();
  drawShipping($districts);
  drawFooter();
?>