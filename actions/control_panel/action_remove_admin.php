<?php
  declare(strict_types = 1);

  session_start();

  require_once('../../database/connection.db.php');
  require_once('../../database/users.class.php');

  $db = getDatabaseConnection();

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $name = $_POST['name'];
            
      Users::removeAdmin($db, $name);
  }

  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>