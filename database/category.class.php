<?php 
    declare(strict_types=1);

    class Category{
        public int $id;
        public string $name;

    public function __construct(int $id, string $name){
        $this->id = $id;
        $this->name = $name;
    }

    // CATEGORIES

      static function getCategories(PDO $db) : array {
        $stmt = $db->prepare('
          SELECT categoryID, categoryName 
          FROM CATEGORY 
        ');

        $stmt->execute();
        $categories = $stmt->fetchAll();
        return $categories;
      }


      static function addCategory(PDO $db, $name) {
        $stmt = $db->prepare('
          INSERT INTO CATEGORY (categoryName) 
          VALUES (?)
        ');

        $stmt->execute(array($name));
      }

      static function removeCategory(PDO $db, $name) {
        $stmt = $db->prepare('
          DELETE FROM CATEGORY
          WHERE categoryName = ?
        ');

        $stmt->execute(array($name));
      }


    // DISTRICTS

      static function getDistricts(PDO $db) : array {
        $stmt = $db->prepare('
          SELECT locationID, locationName 
          FROM LOCATION_ 
        ');

        $stmt->execute();
        $categories = $stmt->fetchAll();
        return $categories;
      }

      static function addDistrict(PDO $db, $name) {
        $stmt = $db->prepare('
          INSERT INTO LOCATION_ (locationName) 
          VALUES (?)
        ');

        $stmt->execute(array($name));
      }

      static function removeDistrict(PDO $db, $name) {
        $stmt = $db->prepare('
          DELETE FROM LOCATION_
          WHERE locationName = ?
        ');

        $stmt->execute(array($name));
      }


    // BRANDS

      static function getBrands(PDO $db) : array {
        $stmt = $db->prepare('
          SELECT brandID, brandName 
          FROM BRAND 
        ');

        $stmt->execute();
        $categories = $stmt->fetchAll();
        return $categories;
      }

      static function addBrand(PDO $db, $name) {
        $stmt = $db->prepare('
          INSERT INTO BRAND (brandName) 
          VALUES (?)
        ');

        $stmt->execute(array($name));
      }

      static function removeBrand(PDO $db, $name) {
        $stmt = $db->prepare('
          DELETE FROM BRAND
          WHERE brandName = ?
        ');

        $stmt->execute(array($name));
      }

    // CONDITIONS

      static function getConditions(PDO $db) : array {
        $stmt = $db->prepare('
          SELECT conditionID, conditionName 
          FROM CONDITION 
        ');

        $stmt->execute();
        $categories = $stmt->fetchAll();
        return $categories;
      }
      
      static function addCondition(PDO $db, $name) {
        $stmt = $db->prepare('
          INSERT INTO CONDITION (conditionName) 
          VALUES (?)
        ');

        $stmt->execute(array($name));
      }

      static function removeCondition(PDO $db, $name) {
        $stmt = $db->prepare('
          DELETE FROM CONDITION
          WHERE conditionName = ?
        ');

        $stmt->execute(array($name));
      }
    }
?>