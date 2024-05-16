<?php
declare(strict_types=1);

class Photo {
    public static function getProductPhotos(PDO $db, $productID): array {
        $stmt = $db->prepare('SELECT photoURL FROM PHOTO WHERE productID = ?');
        $stmt->execute(array($productID));
        return $stmt->fetchAll();
    }
}
?>
