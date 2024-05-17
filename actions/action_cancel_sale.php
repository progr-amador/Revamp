<?php
  declare(strict_types = 1);

  session_start();

  require_once('../database/connection.db.php');
  require_once('../database/baskets.class.php');
  require_once('../database/product.class.php');

  $db = getDatabaseConnection();

  $productID = $_GET['id'];

  Product::removeReserved($db, intval($productID));

  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>