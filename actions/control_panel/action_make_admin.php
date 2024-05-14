<?php
  declare(strict_types = 1);

  session_start();

  require_once('../../database/connection.db.php');
  require_once('../../database/users.class.php');

  $db = getDatabaseConnection();

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $name = $_POST['name'];
            
      Users::makeAdmin($db, $name);
  }

  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $name = $_GET['name'];
          
    Users::makeAdmin($db, $name);
}

  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>