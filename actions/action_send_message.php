<?php
declare(strict_types=1);

session_start();

require_once('../database/connection.db.php');
require_once('../database/message.class.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = filter_input(INPUT_POST, 'message-input', FILTER_UNSAFE_RAW);
    $chatID = filter_input(INPUT_POST, 'chatID', FILTER_VALIDATE_INT);

    if ($message && $chatID) {
        $db = getDatabaseConnection();

        try {
            Message::sendMessage($db, $chatID, $_SESSION['user_id'], $message);
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        } catch (PDOException $e) {
            error_log('Failed to send message: ' . $e->getMessage());
            $_SESSION['error_message'] = 'Failed to send message.';
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
