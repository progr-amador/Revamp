<?php
declare(strict_types=1);

session_start();

require_once('../database/connection.db.php');
require_once('../database/message.class.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buyerID'], $_POST['sellerID'], $_POST['productID'])) {
    $buyerID = filter_var($_POST['buyerID'], FILTER_VALIDATE_INT);
    $sellerID = filter_var($_POST['sellerID'], FILTER_VALIDATE_INT);
    $productID = filter_var($_POST['productID'], FILTER_VALIDATE_INT);

    if ($buyerID !== false && $sellerID !== false && $productID !== false && $buyerID > 0 && $sellerID > 0 && $productID > 0) {
        $db = getDatabaseConnection();

        $chatID = Message::addChat($db, $buyerID, $sellerID, $productID);

        if ($chatID !== null) {
            if($chatID === 0) header("Location: ../code/message.php?");
            else header("Location: ../code/message.php?chatID=$chatID");
            exit();
        } else {
            
            $_SESSION['error_message'] = 'Error creating chat.';
        }
    } else {
        
        $_SESSION['error_message'] = 'Invalid input parameters.';
    }
}

header("Location: ../code/home.php");
exit();
?>
