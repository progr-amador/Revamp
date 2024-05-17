<?php
  declare(strict_types = 1);

  session_start();

  require_once('../database/connection.db.php');
  require_once('../database/baskets.class.php');
  require_once('../database/product.class.php');

  $db = getDatabaseConnection();

  $cart = Baskets::getCart($db, $_SESSION['user_id']);

  if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    foreach ($cart as $product) {
      Product::setReserved($db, intval($product['productID']));
    }
  }

  Baskets::emptyCart($db, $_SESSION['user_id']);

  if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    header('Location: ../code/home.php');
  }

  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>