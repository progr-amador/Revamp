<?php 
declare(strict_types=1);

class Category {
    public int $id;
    public string $name;

    public function __construct(int $id, string $name) {
        $this->id = $id;
        $this->name = $name;
    }

    // CATEGORIES

    public static function getCategories(PDO $db): array {
        $stmt = $db->query('
            SELECT categoryID, categoryName 
            FROM CATEGORY
        ');

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function addCategory(PDO $db, string $name): void {
        $stmt = $db->prepare('
            INSERT INTO CATEGORY (categoryName) 
            VALUES (:name)
        ');

        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
    }

    public static function removeCategory(PDO $db, string $name): void {
        $stmt = $db->prepare('
            DELETE FROM CATEGORY
            WHERE categoryName = :name
        ');

        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
    }

    // DISTRICTS

    public static function getDistricts(PDO $db): array {
        $stmt = $db->query('
            SELECT locationID, locationName 
            FROM LOCATION_
        ');

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function addDistrict(PDO $db, string $name): void {
        $stmt = $db->prepare('
            INSERT INTO LOCATION_ (locationName) 
            VALUES (:name)
        ');

        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
    }

    public static function removeDistrict(PDO $db, string $name): void {
        $stmt = $db->prepare('
            DELETE FROM LOCATION_
            WHERE locationName = :name
        ');

        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
    }

    // BRANDS

    public static function getBrands(PDO $db): array {
        $stmt = $db->query('
            SELECT brandID, brandName 
            FROM BRAND
        ');

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function addBrand(PDO $db, string $name): void {
        $stmt = $db->prepare('
            INSERT INTO BRAND (brandName) 
            VALUES (:name)
        ');

        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
    }

    public static function removeBrand(PDO $db, string $name): void {
        $stmt = $db->prepare('
            DELETE FROM BRAND
            WHERE brandName = :name
        ');

        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
    }

    // CONDITIONS

    public static function getConditions(PDO $db): array {
        $stmt = $db->query('
            SELECT conditionID, conditionName 
            FROM CONDITION
        ');

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function addCondition(PDO $db, string $name): void {
        $stmt = $db->prepare('
            INSERT INTO CONDITION (conditionName) 
            VALUES (:name)
        ');

        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
    }

    public static function removeCondition(PDO $db, string $name): void {
        $stmt = $db->prepare('
            DELETE FROM CONDITION
            WHERE conditionName = :name
        ');

        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
    }
}
?>
