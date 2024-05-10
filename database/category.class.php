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
          SELECT categoryName 
          FROM CATEGORY 
        ');

        $stmt->execute();
        $categories = $stmt->fetchAll();
        return $categories;
      }

      static function getDistricts(PDO $db) : array {
        $stmt = $db->prepare('
          SELECT locationName 
          FROM LOCATION_ 
        ');

        $stmt->execute();
        $categories = $stmt->fetchAll();
        return $categories;
      }

      static function getBrands(PDO $db) : array {
        $stmt = $db->prepare('
          SELECT brandName 
          FROM BRAND 
        ');

        $stmt->execute();
        $categories = $stmt->fetchAll();
        return $categories;
      }
    }
?>