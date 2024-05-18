<?php
declare(strict_types=1);

session_start();

require_once('../database/connection.db.php');
require_once('../database/message.class.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (isset($_POST['message-input'], $_POST['chatID'])) {
        
        $message = $_POST['message-input'];
        $chatID = $_POST['chatID'];

        $db = getDatabaseConnection();

        try {
            Message::sendMessage($db, (int)$chatID, $_SESSION['user_id'], $message);
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        } catch (PDOException $e) {
            $_SESSION['error_message'] = 'Failed to send message: ' . $e->getMessage();
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
    } else {

        $_SESSION['error_message'] = 'Message or chat ID missing.';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;
?>
