<?php 
    declare(strict_types=1);

    class Product{
      public int $id;
      public int $seller;
      public int $brand;
      public int $category;
      public int $location;
      public int $condition;
      public int $price;
      public string $title;
      public string $description;

    public function __construct(int $seller,int $brand,int $category,int $location,int $condition,int $price,string $title, string $description,int $id = 0){
      $this->id = $id;
      $this->seller = $seller;
      $this->brand = $brand;
      $this->category = $category;
      $this->location = $location;
      $this->condition = $condition;
      $this->price = $price;
      $this->title = $title;
      $this->description = $description;
    }

    public function save(PDO $db, array $paths): bool {
      try {
          $db->beginTransaction();

          $stmt = $db->prepare('
              INSERT INTO PRODUCT (sellerID, brandID, categoryID, locationID, conditionID, title, description, price) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?)
          ');

          $stmt->execute([
              $this->seller,
              $this->brand,
              $this->category,
              $this->location,
              $this->condition,
              $this->title,
              $this->description,
              $this->price
          ]);

          $productID = (int) $db->lastInsertId();

          $stmt = $db->prepare('
              INSERT INTO PHOTO (productID, photoURL) VALUES (?, ?)
          ');

          foreach ($paths as $path) {
              $stmt->execute([$productID, $path]);
          }

          $db->commit();
          return true;
          
      } catch (PDOException $e) {
          $db->rollBack();
          error_log('Failed to save product: ' . $e->getMessage());
          return false;
      }
  } 


    public static function removeProduct(PDO $db, int $productID): bool {
        try {
            $stmt = $db->prepare('DELETE FROM PRODUCT WHERE productID = ?');
            return $stmt->execute([$productID]);
        } catch (PDOException $e) {
            error_log('Failed to remove product: ' . $e->getMessage());
            return false;
        }
    }

    static function searchProducts(PDO $db, $filters, $count) : array {
      $sql = '
          SELECT productID, title, price, locationName AS location, photoURL
          FROM PRODUCT
          JOIN LOCATION_ USING (locationID)
          JOIN PHOTO USING (productID)
          JOIN CATEGORY USING (categoryID)
          JOIN BRAND USING (brandID)
          JOIN CONDITION USING (conditionID) 
          LEFT JOIN RESERVED USING (productID)
          WHERE title LIKE ? AND RESERVED.productID IS NULL
      ';

      $search = $filters['search'];
      $params = ["%$search%"];
  
      if (!empty($filters['condition'])) {
          $sql .= ' AND conditionName = ?';
          $params[] = $filters['condition'];
      }
  
      if (!empty($filters['district'])) {
          $sql .= ' AND locationName = ?';
          $params[] = $filters['district'];
      }
  
      if (!empty($filters['category'])) {
          $sql .= ' AND categoryName = ?';
          $params[] = $filters['category'];
      }
  
      if (!empty($filters['brand'])) {
          $sql .= ' AND brandName = ?';
          $params[] = $filters['brand'];
      }

      if (!empty($filters['price_min'])) {
        $sql .= ' AND price >= ?';
        $params[] = $filters['price_min'];
      }

      if (!empty($filters['price_max'])) {
        $sql .= ' AND price <= ?';
        $params[] = $filters['price_max'];
      }

      $sql .= ' GROUP BY productID';

      if (!empty($filters['order'])) {
        $orderParts = explode(' ', $filters['order']);
        $orderBy = $orderParts[0];
        $orderDirection = $orderParts[1] ?? 'ASC';
    
        $sql .= " ORDER BY $orderBy $orderDirection";
    }
  
      $sql .= ' LIMIT ?';
      $params[] = $count;
  
      $stmt = $db->prepare($sql);
      $stmt->execute($params);
  
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  static function getFeatured(PDO $db): array{
    $stmt = $db->prepare('
      SELECT productID, title, price, locationName AS location, photoURL
      FROM PRODUCT
      LEFT JOIN LOCATION_ USING (locationID)
      JOIN PHOTO USING (productID)
      LEFT JOIN RESERVED USING (productID)
      WHERE RESERVED.productID IS NULL
      GROUP BY productID
      ORDER BY price ASC
      LIMIT 20
    ');

    $stmt->execute();
    return $stmt->fetchAll();
  }

    static function getCategory(PDO $db, string $category): array {
      $stmt = $db->prepare('
        SELECT productID, title, price, locationName AS location, photoURL, categoryName
        FROM PRODUCT
        LEFT JOIN LOCATION_ USING (locationID)
        LEFT JOIN CATEGORY USING (categoryID)
        JOIN PHOTO USING (productID)
        LEFT JOIN RESERVED USING (productID)
        WHERE categoryName = ? AND RESERVED.productID IS NULL
        GROUP BY productID
        ORDER BY price ASC
      ');
  
      $stmt->execute([$category]); 
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    static function getProduct(PDO $db, $id): array{
        $stmt = $db->prepare('
        SELECT productID, sellerID, brandID, categoryID, categoryName, product.locationID, title, description, price, conditionName AS condition, photoURL, username AS seller, locationName AS location
        FROM PRODUCT 
        JOIN USERS ON PRODUCT.sellerID=USERS.userID
        LEFT JOIN BRAND USING (brandID)
        LEFT JOIN CATEGORY USING (categoryID)
        LEFT JOIN LOCATION_ USING (locationID)
        LEFT JOIN CONDITION USING (conditionID)
        JOIN PHOTO USING (productID)
        WHERE productId = ?
        GROUP BY productID
      ');

      $stmt->execute([$id]);
      return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    static function getUserListings(PDO $db, $userID): array {
      $stmt = $db->prepare('
        SELECT productID, title, price, locationName AS location, photoURL, categoryName, sellerID
        FROM PRODUCT
        LEFT JOIN LOCATION_ USING (locationID)
        LEFT JOIN CATEGORY USING (categoryID)
        JOIN PHOTO USING (productID)
        LEFT JOIN RESERVED USING (productID)
        WHERE sellerID = ? AND RESERVED.productID IS NULL
        GROUP BY productID
      ');
  
      $stmt->execute([$userID]); 
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getReserved(PDO $db, int $userID): array {
      $stmt = $db->prepare('
          SELECT productID, title, price, locationName AS location, photoURL, categoryName, sellerID
          FROM PRODUCT
          LEFT JOIN LOCATION_ USING (locationID)
          LEFT JOIN CATEGORY USING (categoryID)
          JOIN PHOTO USING (productID)
          JOIN RESERVED USING (productID)
          WHERE sellerID = ?
          GROUP BY productID
      ');

      $stmt->execute([$userID]); 
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    static function getReservedProduct(PDO $db, int $productID): array {
      $stmt = $db->prepare('
        SELECT name, district, street, door, localidade, postalCode AS postal_code
        FROM RESERVED
        WHERE productID = ?
        GROUP BY productID
      ');
  
      $stmt->execute([$productID]); 
      $product = $stmt->fetch(PDO::FETCH_ASSOC);
      return $product;
    }

    public static function setReserved(PDO $db, int $productID): bool {
      try {
          $stmt = $db->prepare('
              INSERT INTO RESERVED (productID) 
              VALUES (?)
          ');
          return $stmt->execute([$productID]);
      } catch (PDOException $e) {
          error_log('Failed to set product as reserved: ' . $e->getMessage());
          return false;
      }
    }

    public static function removeReserved(PDO $db, int $productID): bool {
      try {
          $stmt = $db->prepare('DELETE FROM RESERVED WHERE productID = ?');
          return $stmt->execute([$productID]);
      } catch (PDOException $e) {
          error_log('Failed to remove reserved product: ' . $e->getMessage());
          return false;
      }
    }
  
  }

?>