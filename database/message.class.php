<?php 
declare(strict_types=1);

class Message{

    
    public static function getChats(PDO $db, int $userID): array {
        try {
            
            $stmt = $db->prepare('
                SELECT chatID, photoURL, title, CHAT.sellerID, BUYER.username as buyerName, SELLER.username as sellerName
                FROM CHAT
                JOIN PRODUCT USING (productID)
                JOIN PHOTO USING (productID)
                JOIN USERS AS BUYER ON CHAT.buyerID = BUYER.userID
                JOIN USERS AS SELLER ON CHAT.sellerID = SELLER.userID
                WHERE CHAT.sellerID = :userID OR buyerID = :userID
                GROUP BY chatID
            ');
            $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            
            error_log('Failed to fetch chats: ' . $e->getMessage());
            return [];
        }
    }

    
    public static function getMessages(PDO $db, int $chatID): array {
        try {
            
            $stmt = $db->prepare('
                SELECT messageText, username as senderName, senderID, messageDate
                FROM MESSAGE_
                JOIN CHAT USING (chatID)
                JOIN USERS ON MESSAGE_.senderID = USERS.userID
                WHERE chatID = :chatID
                ORDER BY messageDate
            ');
            $stmt->bindParam(':chatID', $chatID, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            
            error_log('Failed to fetch messages: ' . $e->getMessage());
            return [];
        }
    }

    
    public static function sendMessage(PDO $db, int $chatID, int $senderID, string $message): bool {
        try {
            
            $stmt = $db->prepare('
                INSERT INTO MESSAGE_ (chatID, senderID, messageText, messageDate) 
                VALUES (:chatID, :senderID, :message, :displayDate)
            ');
            
            $date = new DateTime('now');
            $displayDate = $date->format('Y-m-d H:i:s');
            $stmt->bindParam(':chatID', $chatID, PDO::PARAM_INT);
            $stmt->bindParam(':senderID', $senderID, PDO::PARAM_INT);
            $stmt->bindParam(':message', $message, PDO::PARAM_STR);
            $stmt->bindParam(':displayDate', $displayDate, PDO::PARAM_STR);
            return $stmt->execute();
        } catch (PDOException $e) {
            
            error_log('Failed to send message: ' . $e->getMessage());
            return false;
        }
    }

    
    public static function addChat(PDO $db, int $buyerID, int $sellerID, int $productID): int {
        try {
            
            $stmt = $db->prepare('
                INSERT INTO CHAT (buyerID, sellerID, productID) 
                VALUES (:buyerID, :sellerID, :productID)
            ');
            $stmt->bindParam(':buyerID', $buyerID, PDO::PARAM_INT);
            $stmt->bindParam(':sellerID', $sellerID, PDO::PARAM_INT);
            $stmt->bindParam(':productID', $productID, PDO::PARAM_INT);
            $stmt->execute();
            
            return (int) $db->lastInsertId();
        } catch (PDOException $e) {
            
            error_log('Failed to add chat: ' . $e->getMessage());
            return 0;
        }
    }

    public static function canViewMessage(PDO $db, int $userID, int $chatID): bool {
        try {
            $stmt = $db->prepare('
                SELECT 1 
                FROM CHAT 
                WHERE chatID = :chatID 
                AND (:userID = buyerID OR :userID = sellerID)
            ');
            $stmt->bindParam(':chatID', $chatID, PDO::PARAM_INT);
            $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetch(PDO::FETCH_ASSOC) !== false;
        } catch (PDOException $e) {
            error_log('Failed to check if user can view message: ' . $e->getMessage());
            return false;
        }
    }
}
?>
