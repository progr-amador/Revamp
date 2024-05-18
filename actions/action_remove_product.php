<?php
  declare(strict_types = 1);

  session_start();

  require_once('../database/connection.db.php');
  require_once('../database/product.class.php');

  $db = getDatabaseConnection();

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $productID = $_POST['productID'];
            
      Product::removeProduct($db, intval($productID));
      header('Location: ../code/home.php');
  }

  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $productID = $_GET['productID'];
          
    Product::removeProduct($db, intval($productID));
    header('Location: ../code/reserved.php');
}

  header('Location: ../code/home.php');
?>