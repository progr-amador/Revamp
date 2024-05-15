<?php
  declare(strict_types = 1);

  session_start();

  require_once('../database/connection.db.php');
  require_once('../database/message.class.php');

  $db = getDatabaseConnection();

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = $_POST['message-input'];
    $chatID = $_POST['chatID'];
            
    Message::sendMessage($db, $chatID, $_SESSION['user_id'], $message);
  }

  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>