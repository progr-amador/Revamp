<?php
  declare(strict_types = 1);

  session_start();

  require_once('../../database/connection.db.php');
  require_once('../../database/category.class.php');

  $db = getDatabaseConnection();

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $name = $_POST['name'];
            
      Category::addDistrict($db, $name);
  }

  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>