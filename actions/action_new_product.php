<?php
  declare(strict_types = 1);

  session_start();

  require_once('../database/connection.db.php');
  require_once('../database/product.class.php');

  $db = getDatabaseConnection();

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $seller = $_SESSION['user_id'];
      $brand = $_POST['brand'] ?? 0;
      $category = $_POST['category'] ?? 0;
      $location = $_POST['location'] ?? 0;
      $condition = $_POST['condition'] ?? 0;
      $price = $_POST['price'] ?? 0;
      $title = $_POST['title'] ?? '';
      $description = $_POST['description'] ?? '';
            
      $newProduct = new Product($seller,intval($brand),intval($category),intval($location),intval($condition),intval($price),$title,$description);

      $newProduct->save($db);
  }

header('Location: ../code/my_listings.php');
?>