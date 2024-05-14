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

    public function save(PDO $db, $paths) {
      $stmt = $db->prepare('
        INSERT INTO PRODUCT (sellerID, brandID, categoryID, locationID, conditionID, title, description, price) 
        VALUES (?,?,?,?,?,?,?,?) 
      ');

      $stmt->execute([
        $this->seller,
        $this->brand,
        $this->category,
        $this->location,
        $this->condition,
        $this->title,
        $this->description,
        $this->price,
      ]);

      $productID = $db->lastInsertId();

      $stmt = $db->prepare('
        INSERT INTO PHOTO (productID, photoURL) VALUES
        (?, ?) 
      ');

      foreach ($paths as $path) {
        $stmt->execute([$productID, $path]);
      }
    } 


    static function removeProduct(PDO $db, int $productID) {
      $stmt = $db->prepare('DELETE FROM PRODUCT WHERE productID = ?');
      $stmt->execute([$productID]);
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
          WHERE title LIKE ?
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
  
      $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $products;
  }

  static function getFeatured(PDO $db): array{
    $stmt = $db->prepare('
      SELECT productID, title, price, locationName AS location, photoURL
      FROM PRODUCT
      LEFT JOIN LOCATION_ USING (locationID)
      JOIN PHOTO USING (productID)
      GROUP BY productID
      ORDER BY price ASC
      LIMIT 20
    ');

    $stmt->execute();
    $featured = $stmt->fetchAll();
    return $featured;
  }

    static function getCategory(PDO $db, string $category): array {
      $stmt = $db->prepare('
        SELECT productID, title, price, locationName AS location, photoURL, categoryName
        FROM PRODUCT
        LEFT JOIN LOCATION_ USING (locationID)
        LEFT JOIN CATEGORY USING (categoryID)
        JOIN PHOTO USING (productID)
        WHERE categoryName LIKE ?
        GROUP BY productID
        ORDER BY price ASC
      ');
  
      $stmt->execute(array("%$category%")); 
      $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $products;
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

      $stmt->execute(array($id));

      $product = $stmt->fetch(PDO::FETCH_ASSOC);

      return $product;
    }

    static function getUserListings(PDO $db, $userID): array {
      $stmt = $db->prepare('
        SELECT productID, title, price, locationName AS location, photoURL, categoryName, sellerID
        FROM PRODUCT
        LEFT JOIN LOCATION_ USING (locationID)
        LEFT JOIN CATEGORY USING (categoryID)
        JOIN PHOTO USING (productID)
        WHERE sellerID LIKE ?
        GROUP BY productID
      ');
  
      $stmt->execute(array($userID)); 
      $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $products;
    }
  
  }

?>