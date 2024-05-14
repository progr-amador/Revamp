<?php
  declare(strict_types = 1);

  session_start();

  require_once('../database/connection.db.php');
  require_once('../database/product.class.php');

  $db = getDatabaseConnection();

  $products = Product::searchProducts($db, $_GET['search'], 20);

  echo json_encode($products);
?>