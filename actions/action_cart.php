<?php
  declare(strict_types = 1);

  session_start();

  require_once('../database/connection.db.php');
  require_once('../database/baskets.class.php');

  $db = getDatabaseConnection();

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $productID = $_POST['productID'];
            
      Baskets::saveCart($db, $_SESSION['user_id'], intval($productID));
  }

  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>