<?php 
declare(strict_types=1);

class Message{

    static function getChats(PDO $db, $userID): array{
        $stmt = $db->prepare( '
            SELECT chatID, photoURL, title, CHAT.sellerID, BUYER.username as buyerName, SELLER.username as sellerName
            FROM CHAT
            JOIN PRODUCT USING (productID)
            JOIN PHOTO USING (productID)
            JOIN USERS AS BUYER ON CHAT.buyerID = BUYER.userID
            JOIN USERS AS SELLER ON CHAT.sellerID = SELLER.userID
            WHERE CHAT.sellerID = ? OR buyerID = ?
            GROUP BY chatID
        ');

        $stmt->execute(array($userID, $userID));
        $chats = $stmt->fetchAll();
        return $chats;
    }

    static function getMessages(PDO $db, $chatID): array{
        $stmt = $db->prepare( '
            SELECT messageText, username as senderName, senderID, messageDate
            FROM MESSAGE_
            JOIN CHAT USING (chatID)
            JOIN USERS ON MESSAGE_.senderID = USERS.userID
            WHERE chatID = ?
            ORDER BY messageDate
            ');

        $stmt->execute(array($chatID));
        $messages = $stmt->fetchAll();
        return $messages;
    }

    

    static function sendMessage(PDO $db, $chatID, $senderID, $message) {
        $stmt = $db->prepare('
            INSERT INTO MESSAGE_ (chatID, senderID, messageText, messageDate) 
            VALUES (?,?,?,?)
        ');

        $date = new DateTime('now');
        $displayDate = $date->format('Y-m-d H:i:s');

        $stmt->execute([$chatID, $senderID, $message, $displayDate]);
    }

    static function addChat($db, $buyerID, $sellerID, $productID) : int {
    $stmt = $db->prepare('
        INSERT INTO CHAT (buyerID, sellerID, productID) 
        VALUES (?,?,?)
    ');

    $stmt->execute([$buyerID, $sellerID, $productID]);

    return intval($db->lastInsertId());
    }


}
?>
