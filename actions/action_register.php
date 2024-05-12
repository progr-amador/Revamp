<?php
  declare(strict_types = 1);

  session_start();

  require_once('../database/connection.db.php');
  require_once('../database/users.class.php');

  $db = getDatabaseConnection();

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $username = $_POST['username'] ?? '';
      $password = $_POST['password'] ?? '';
      $email = $_POST['email'] ?? '';
          
      $newUser = new Users($username, $email);
  
      $newUser->save($db, $password);  // Save the user
  }

header('Location: ../code/login.php');
?>