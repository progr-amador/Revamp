<?php
  declare(strict_types = 1);

  require_once('../database/connection.db.php');
  require_once('../database/category.class.php');

  require_once('../templates/common.tpl.php');
  require_once('../templates/shipping.tpl.php');

  $db = getDatabaseConnection();
  $name = 'Envio';

  $districts = Brand::getDistricts($db);

  drawHead($name);
  drawHeader();
  drawShipping($districts);
  drawFooter();
?>