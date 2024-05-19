<?php
  declare(strict_types = 1);

  session_start();

  require_once('../database/connection.db.php');
  require_once('../database/product.class.php');

  require_once('../templates/common.tpl.php');
  require_once('../templates/category.tpl.php');

  $db = getDatabaseConnection();
  $category = $_GET['id'];

  $products = Product::getCategory($db, $category);

  drawHead($category);
  drawHeader();
  drawCategory($products);
  drawFooter();
?>