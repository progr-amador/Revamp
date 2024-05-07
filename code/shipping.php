<?php
  declare(strict_types = 1);

  //require_once('../database/connection.db.php');

  require_once('../templates/common.tpl.php');
  require_once('../templates/shipping.tpl.php');

  //$db = getDatabaseConnection();
  $name = 'Shipping Form';

  drawHead($category);
  drawHeader();
  drawShipping();
  drawFooter();
?>