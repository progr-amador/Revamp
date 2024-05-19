<?php
  declare(strict_types = 1);

  session_start();

  require_once('../database/connection.db.php');
  require_once('../database/message.class.php');

  require_once('../templates/common.tpl.php');
  require_once('../templates/message.tpl.php');

  $db = getDatabaseConnection();
  $name = 'Mensagens';
  $conversation = $_GET['chatID'] ?? 0;

  $chats = Message::getChats($db, $_SESSION['user_id']);
  $messages = Message::getMessages($db, intval($conversation));

  drawHead($name);
  drawHeader();
  drawMessage($chats, $messages, $conversation);
  drawFooter();
?>