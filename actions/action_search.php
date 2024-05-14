<?php
  declare(strict_types = 1);

  session_start();

  require_once('../database/connection.db.php');
  require_once('../database/product.class.php');

  $db = getDatabaseConnection();

  // Extract search and filter parameters from $_GET superglobal
    $search = $_GET['search'] ?? $_GET['query'];
    $filters = [
        'search' => $search,
        'condition' => $_GET['condition'] ?? '',
        'district' => $_GET['district'] ?? '',
        'category' => $_GET['category'] ?? '',
        'brand' => $_GET['brand'] ?? '',
        'order' => $_GET['order'] ?? '',
        'price_min' => $_GET['price_min'] ?? '',
        'price_max' => $_GET['price_max'] ?? '',
    ];

  $products = Product::searchProducts($db, $filters, 20);

  echo json_encode($products);
?>