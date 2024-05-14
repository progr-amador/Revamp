<?php 
    declare(strict_types=1);

    class Baskets{

    // CART

    static function saveCart(PDO $db, int $buyerID, int $productID) {
      $stmt = $db->prepare('INSERT OR IGNORE INTO CART (buyerID, productID, quantity) VALUES (?,?, 1)');
      $stmt->execute([$buyerID, $productID]);
    }

    static function emptyCart(PDO $db, int $buyerID) {
      $stmt = $db->prepare('DELETE FROM CART WHERE buyerID = ?');
      $stmt->execute([$buyerID]);
    }

    static function getCart(PDO $db, $userID): array{
      $stmt = $db->prepare( '
        SELECT productID, title, price, locationName AS location, photoURL
        FROM PRODUCT
        LEFT JOIN LOCATION_ USING (locationID)
        JOIN PHOTO USING (productID)
        JOIN CART USING (productID)
        WHERE buyerID = ?
        GROUP BY productID
      ');
  
      $stmt->execute(array($userID));
      $favorites = $stmt->fetchAll();
      return $favorites;
    }

    // FAVORITES

    static function saveFavorite(PDO $db, int $buyerID, int $productID) {
      $stmt = $db->prepare('INSERT OR IGNORE INTO FAVORITES (buyerID, productID) VALUES (?,?)');
      $stmt->execute([$buyerID, $productID]);
    }

    static function emptyFavorites(PDO $db, int $buyerID) {
      $stmt = $db->prepare('DELETE FROM FAVORITES WHERE buyerID = ?');
      $stmt->execute([$buyerID]);
    }

    static function getFavorites(PDO $db, $userID): array{
      $stmt = $db->prepare( '
        SELECT productID, title, price, locationName AS location, photoURL
        FROM PRODUCT
        LEFT JOIN LOCATION_ USING (locationID)
        JOIN PHOTO USING (productID)
        JOIN FAVORITES USING (productID)
        WHERE buyerID = ?
        GROUP BY productID
      ');
  
      $stmt->execute(array($userID));
      $favorites = $stmt->fetchAll();
      return $favorites;
    }


    }
?>
