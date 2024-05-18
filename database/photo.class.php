<?php
declare(strict_types=1);

class Photo {
    public static function getProductPhotos(PDO $db, int $productID): array {
        $stmt = $db->prepare('SELECT photoURL FROM PHOTO WHERE productID = :productID');
        $stmt->bindParam(':productID', $productID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
?>

