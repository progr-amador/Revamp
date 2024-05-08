<?php 
    declare(strict_types=1);

    class Brand{
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


      static function searchCategories(PDO $db, string $search, int $count) : array {
        $stmt = $db->prepare(
            'SELECT categoryID, categoryName FROM CATEGORY WHERE categoryName LIKE ? LIMIT ?');

        $stmt->execute(array($search . '%', $count));
    
        $categories = array();
        while ($category = $stmt->fetch()) {
          $categories[] = new Category(
            $category['categoryID'],
            $category['categoryName']
          );
        }
    
        return $categories;
      }

      static function getCategory(PDO $db, int $id) : array {
        $stmt = $db->prepare(
          'SELECT categoryID, categoryName FROM CATEGORY WHERE categoryID= ?');

        $stmt->execute(array($id));
    
        $category = $stmt->fetch();

        return new Category(
          $category['categoryID'],
          $category['categoryName']
        );
      }
    }
?>