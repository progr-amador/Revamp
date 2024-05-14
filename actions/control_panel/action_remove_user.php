<?php
  declare(strict_types = 1);

  session_start();

  require_once('../../database/connection.db.php');
  require_once('../../database/users.class.php');

  $db = getDatabaseConnection();

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
          
    Users::removeUser($db, $name);
  }

  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $name = $_GET['name'];
          
    Users::removeUser($db, $name);
    header('Location: ../action_logout.php');
    exit;
}

  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>