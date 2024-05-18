<?php 
declare(strict_types=1);

class Baskets {

    // CART

    public static function saveCart(PDO $db, int $buyerID, int $productID): bool {
        $stmt = $db->prepare('INSERT OR IGNORE INTO CART (buyerID, productID, quantity) VALUES (:buyerID, :productID, 1)');
        $stmt->bindParam(':buyerID', $buyerID, PDO::PARAM_INT);
        $stmt->bindParam(':productID', $productID, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public static function emptyCart(PDO $db, int $buyerID): bool {
        $stmt = $db->prepare('DELETE FROM CART WHERE buyerID = :buyerID');
        $stmt->bindParam(':buyerID', $buyerID, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public static function getCart(PDO $db, int $userID): array {
        $stmt = $db->prepare('
            SELECT productID, title, price, locationName AS location, photoURL
            FROM PRODUCT
            LEFT JOIN LOCATION_ USING (locationID)
            JOIN PHOTO USING (productID)
            JOIN CART USING (productID)
            LEFT JOIN RESERVED USING (productID)
            WHERE buyerID = :userID AND RESERVED.productID IS NULL
            GROUP BY productID
        ');

        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getCartTotalPrice(PDO $db, int $buyerID): float {
        $stmt = $db->prepare('
            SELECT SUM(price) as totalPrice
            FROM PRODUCT
            JOIN CART USING (productID)
            LEFT JOIN RESERVED USING (productID)
            WHERE buyerID = :buyerID AND RESERVED.productID IS NULL
        ');

        $stmt->bindParam(':buyerID', $buyerID, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? (float) $result['totalPrice'] : 0.0;
    }

    // FAVORITES

    public static function saveFavorite(PDO $db, int $buyerID, int $productID): bool {
        $stmt = $db->prepare('INSERT OR IGNORE INTO FAVORITES (buyerID, productID) VALUES (:buyerID, :productID)');
        $stmt->bindParam(':buyerID', $buyerID, PDO::PARAM_INT);
        $stmt->bindParam(':productID', $productID, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public static function emptyFavorites(PDO $db, int $buyerID): bool {
        $stmt = $db->prepare('DELETE FROM FAVORITES WHERE buyerID = :buyerID');
        $stmt->bindParam(':buyerID', $buyerID, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public static function getFavorites(PDO $db, int $userID): array {
        $stmt = $db->prepare('
            SELECT productID, title, price, locationName AS location, photoURL
            FROM PRODUCT
            LEFT JOIN LOCATION_ USING (locationID)
            JOIN PHOTO USING (productID)
            JOIN FAVORITES USING (productID)
            LEFT JOIN RESERVED USING (productID)
            WHERE buyerID = :userID AND RESERVED.productID IS NULL
            GROUP BY productID
        ');

        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
