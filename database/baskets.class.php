<?php 
    declare(strict_types=1);

    class Baskets{

    static function saveCart(PDO $db, int $buyerID, int $productID) {
      $stmt = $db->prepare('INSERT OR IGNORE INTO CART (buyerID, productID, quantity) VALUES (?,?, 1)');
      $stmt->execute([$buyerID, $productID]);
    }

    static function saveFavorite(PDO $db, int $buyerID, int $productID) {
      $stmt = $db->prepare('INSERT OR IGNORE INTO FAVORITES (buyerID, productID) VALUES (?,?)');
      $stmt->execute([$buyerID, $productID]);
    }
    }
?>
