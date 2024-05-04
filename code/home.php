<?php
  declare(strict_types = 1);

  require_once('../database/connection.db.php');
  require_once('../database/product.class.php');

  require_once('../templates/common.tpl.php');
  require_once('../templates/home.tpl.php');

  $name = "Home";

  $db = getDatabaseConnection();

  $products = Product::getProducts($db);

  drawHead($name);
  drawHeader();
  drawHome($products);
  drawFooter();
?>