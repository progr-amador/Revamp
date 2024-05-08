<?php
  declare(strict_types = 1);

  require_once('../database/connection.db.php');
  require_once('../database/product.class.php');

  require_once('../templates/product.tpl.php');
  require_once('../templates/common.tpl.php');

  $name = "Produto";
  $db = getDatabaseConnection();
  $ID = $_GET['id'];

  $product = Product::getProduct($db, $ID);

  drawHead($name);
  drawHeader();
  drawProduct($product);
  drawFooter();
?>