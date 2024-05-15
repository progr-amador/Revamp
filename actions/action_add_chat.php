<?php
  declare(strict_types = 1);

  session_start();

  require_once('../database/connection.db.php');
  require_once('../database/message.class.php');

  $db = getDatabaseConnection();
  $chatID = 0;

  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $buyerID = $_GET['buyerID'];
    $sellerID = $_GET['sellerID'];
    $productID = $_GET['productID'];
            
    $chatID = Message::addChat($db, $buyerID, $sellerID, $productID) ?? 0;
  }
  
  header("Location: ../code/message.php?chatID=$chatID");
?>