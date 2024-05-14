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

    static function getFiltered(PDO $db, string $title = '', string $price_min = '', string $price_max = '', string $condition = '', string $district = '', string $category = '', string $brand = ''): array {
      $query = '
          SELECT productID, title, price, locationName AS location, photoURL
          FROM PRODUCT
          JOIN LOCATION_ USING (locationID)
          JOIN PHOTO USING (productID)
          JOIN CATEGORY USING (categoryID)
          JOIN BRAND USING (brandID)
          JOIN CONDITION USING (conditionID)
          WHERE 1=1 ';
  
      $params = array();
  
      if (!empty($title)) {
          $query .= 'AND title LIKE ? ';
          $params[] = "%$title%";
      }
      if (!empty($price_min)) {
          $price_min = intval($price_min);
          $query .= 'AND price >= ? ';
          $params[] = $price_min;
      }
      if (!empty($price_max)) {
          $price_max = intval($price_max);
          $query .= 'AND price <= ? ';
          $params[] = $price_max;
      }
      if (!empty($condition)) {
          $query .= 'AND conditionName = ? ';
          $params[] = $condition;
      }
      if (!empty($district)) {
          $query .= 'AND locationName = ? ';
          $params[] = $district;
      }
      if (!empty($category)) {
          $query .= 'AND categoryName = ? ';
          $params[] = $category;
      }
      if (!empty($brand)) {
          $query .= 'AND brandName = ? ';
          $params[] = $brand;
      }
  
      $query .= 'ORDER BY price ASC';
  
      $stmt = $db->prepare($query);
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

  static function getFavorites(PDO $db, $userID): array{
    $stmt = $db->prepare( '
      SELECT productID, title, price, locationName AS location, photoURL
      FROM PRODUCT
      LEFT JOIN LOCATION_ USING (locationID)
      JOIN PHOTO USING (productID)
      JOIN FAVORITES USING (productID)
      WHERE buyerID = ?
      GROUP BY productID
    ');

    $stmt->execute(array($userID));
    $favorites = $stmt->fetchAll();
    return $favorites;
  }

  static function getCart(PDO $db, $userID): array{
    $stmt = $db->prepare( '
      SELECT productID, title, price, locationName AS location, photoURL
      FROM PRODUCT
      LEFT JOIN LOCATION_ USING (locationID)
      JOIN PHOTO USING (productID)
      JOIN CART USING (productID)
      WHERE buyerID = ?
      GROUP BY productID
    ');

    $stmt->execute(array($userID));
    $favorites = $stmt->fetchAll();
    return $favorites;
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
      $products = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch the results
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
      $products = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch the results
      return $products;
    }

    static function removeProduct(PDO $db, int $productID) {
      $stmt = $db->prepare('DELETE FROM PRODUCT WHERE productID = ?');
      $stmt->execute([$productID]);
    }
  }

?>