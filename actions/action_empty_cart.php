<?php
  declare(strict_types = 1);

  session_start();

  require_once('../database/connection.db.php');
  require_once('../database/baskets.class.php');

  $db = getDatabaseConnection();

  Baskets::emptyCart($db, $_SESSION['user_id']);

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {      
    header('Location: ../code/home.php');
  }

  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>