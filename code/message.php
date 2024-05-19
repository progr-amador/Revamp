<?php
  declare(strict_types = 1);

  session_start();

  require_once('../database/connection.db.php');
  require_once('../database/message.class.php');
  require_once('../csrf_token.php');
  require_once('../templates/common.tpl.php');
  require_once('../templates/message.tpl.php');

  $db = getDatabaseConnection();
  $name = 'Mensagens';
  $conversation = $_GET['chatID'] ?? 0;

  if (($conversation !== 0) && (!isset($_SESSION['user_id']) || !Message::canViewMessage($db, $_SESSION['user_id'], intval($conversation)))) {
    header('Location: ../code/home.php');
    exit;
  }


  $chats = Message::getChats($db, $_SESSION['user_id']);
  $messages = Message::getMessages($db, intval($conversation));

  drawHead($name);
  drawHeader();
  drawMessage($chats, $messages, intval($conversation));
  drawFooter();
?>