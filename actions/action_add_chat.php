<?php
declare(strict_types = 1);

session_start();

require_once('../database/connection.db.php');
require_once('../database/message.class.php');


if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['buyerID'], $_GET['sellerID'], $_GET['productID'])) {
    $buyerID = intval($_GET['buyerID']);
    $sellerID = intval($_GET['sellerID']);
    $productID = intval($_GET['productID']);

    if ($buyerID > 0 && $sellerID > 0 && $productID > 0) {
        $db = getDatabaseConnection();

        
        $chatID = Message::addChat($db, $buyerID, $sellerID, $productID) ?? 0;

        // Redirect to the message page with the chatID parameter
        header("Location: ../code/message.php?chatID=$chatID");
        exit();
    }
}

// If input parameters are invalid
header("Location: ../code/home.php");
exit();
?>
