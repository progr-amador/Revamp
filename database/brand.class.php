<?php 
    declare(strict_types=1);

    class Brand{
        public int $id;
        public string $name;
    }

    public function __construct(int $id, string $name){
        $this->id = $id;
        $this->name = $name;
    }

    static function getBrands(PDO $db, int $count) : array {
        $stmt = $db->prepare(
            'SELECT brandID, brandName FROM BRAND LIMIT ?');

        $stmt->execute(array($count));
    
        $brands = array();
        while ($brand = $stmt->fetch()) {
          $brands[] = new Brand(
            $brand['brandID'],
            $brand['brandName']
          );
        }
    
        return $brands;
      }

      static function searchBrands(PDO $db, string $search, int $count) : array {
        $stmt = $db->prepare(
            'SELECT brandID, brandName FROM BRAND WHERE brandName LIKE ? LIMIT ?');

        $stmt->execute(array($search . '%', $count));
    
        $brands = array();
        while ($brand = $stmt->fetch()) {
          $brands[] = new Brand(
            $brand['brandID'],
            $brand['brandName']
          );
        }
    
        return $brands;
      }

      static function getBrands(PDO $db, int $id) : array {
        $stmt = $db->prepare(
            'SELECT brandID, brandName FROM BRAND WHERE brandID= ?');

        $stmt->execute(array($id));
    
        $brand = $stmt->fetch();

        return new Brand(
            $brand['brandID'],
            $brand['brandName']
          );
      }




?>