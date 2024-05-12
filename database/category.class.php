<?php 
    declare(strict_types=1);

    class Category{
        public int $id;
        public string $name;

    public function __construct(int $id, string $name){
        $this->id = $id;
        $this->name = $name;
    }

      static function getCategories(PDO $db) : array {
        $stmt = $db->prepare('
          SELECT categoryID, categoryName 
          FROM CATEGORY 
        ');

        $stmt->execute();
        $categories = $stmt->fetchAll();
        return $categories;
      }

      static function getDistricts(PDO $db) : array {
        $stmt = $db->prepare('
          SELECT locationID, locationName 
          FROM LOCATION_ 
        ');

        $stmt->execute();
        $categories = $stmt->fetchAll();
        return $categories;
      }

      static function getBrands(PDO $db) : array {
        $stmt = $db->prepare('
          SELECT brandID, brandName 
          FROM BRAND 
        ');

        $stmt->execute();
        $categories = $stmt->fetchAll();
        return $categories;
      }

      static function getConditions(PDO $db) : array {
        $stmt = $db->prepare('
          SELECT conditionID, conditionName 
          FROM CONDITION 
        ');

        $stmt->execute();
        $categories = $stmt->fetchAll();
        return $categories;
      }
    }
?>