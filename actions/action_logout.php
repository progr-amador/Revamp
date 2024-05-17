<?php
  declare(strict_types = 1);

  session_start();

  require_once('../database/connection.db.php');
  $db = getDatabaseConnection();
  $db->exec('DELETE FROM CHAT WHERE chatID NOT IN (SELECT chatID FROM MESSAGE_)');
  
  session_destroy();

  header('Location: ../code/home.php');
?>