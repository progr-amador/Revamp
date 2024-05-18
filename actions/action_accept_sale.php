<?php
  declare(strict_types = 1);

  session_start();

  require_once('../database/connection.db.php');
  require_once('../database/baskets.class.php');
  require_once('../database/product.class.php');

  if (!isset($_SESSION['user_id'])) {
    // Redirect unauthorized users to the login page
    header('Location: ../code/login.php');
    exit();
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  // Redirect with error message if ID is missing or not numeric
  header('Location: ../code/home.php');
  exit();
}

  $db = getDatabaseConnection();

  $productID = intval($_GET['id']);
  $product = Product::getProduct($db, $productID);

  if (!$product || $product['sellerID'] !== $_SESSION['user_id']) {
    // Redirect unauthorized users to the appropriate page
    header('Location: ../code/home.php');
    exit();
}

  Product::removeProduct($db, intval($productID));

  //PARTE DO SHIPPING FORM

  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>